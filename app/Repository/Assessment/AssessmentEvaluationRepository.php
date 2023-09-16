<?php

namespace App\Repository\Assessment;

use App\Models\Question;
use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Models\AssessmentStudent;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Repository\Assessment\AssessmentEvaluationRepositoryInterface;

class AssessmentEvaluationRepository implements AssessmentEvaluationRepositoryInterface
{

	public function assessments()
	{
		return auth()->user()->teacher->assessments()->with(['study_group', 'class', 'subject'])->where('is_expired', false)->get();
	}

	/**
	 * @param Assessment $assessment
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function index(Assessment $assessment)
	{
		return $assessment->students()
			->get();
	}

	/**
	 * @param AssessmentStudent $studentAssessment
	 * 
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getQuestions(AssessmentStudent $studentAssessment)
	{
		return Question::with(['answer' => function (Builder $query) use ($studentAssessment) {
			$query->where('student_id', $studentAssessment->student_id);
			$query->where('assessment_id', $studentAssessment->assessment_id);
		}, 'choices'])
			->whereHas('answer')
			->where('assessment_id', $studentAssessment->assessment_id)
			->get();
	}

	/**
	 * @param Request $request
	 * 
	 * @return bool
	 */
	public function gradeAssessment(Request $request, AssessmentStudent $studentAssessment): bool
	{
		try {

			// Formula for grading assessment
			// Example Assessment 
			// Total Marks = 100
			// Total MCQs = 10
			// Total Essay Questions = 5
			
			// FORMULA

			// Marks for each MCQ = 100 / Total # of MCQs = 100 / 10 = 10
			// If # of correct answers are 5
			// Marks obatined in MCQs = 5 * 10 = 50

			// Total essay marks (Graded by teacher)
			// Total Marks = (Marks obatined in MCQs + Marks Obtained in Essay Questions) / 2
			// Total Marks = (50 + 30 ) / 2 = 80 / 2 = 40

			$assessment 				= Assessment::find($studentAssessment->assessment_id);
			$totalNumberOfMCQs          = $assessment->multiple_choice_questions->count();
			$marksForEachQuestion       = 100 / $totalNumberOfMCQs;
			$numberOfCorrectQuestions   = $assessment->answers()->whereType('Multiple Choice')
				->where('is_correct', true)->count();

			$marksObtainedInMCQs        = $numberOfCorrectQuestions * $marksForEachQuestion;
			$totalMarks                 = ($request->marks + $marksObtainedInMCQs) / 2;

			$studentAssessment->update([
				'marks_obtained' => $totalMarks,
				'is_graded' => true,
			]);

			return true;
		} catch (\Throwable $th) {
            logError($th);
			return false;
		}
	}
}
