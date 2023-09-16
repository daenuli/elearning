<?php

namespace App\Http\Controllers\Student;

use Inertia\Inertia;
use App\Models\Subject;
use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AssessmentQuestionsResource;
use App\Repository\Assessment\AssessmentRepositoryInterface;

class AssessmentController extends Controller
{
    /**
     * ClassController constructor
     * @param App\Repository\Custom\AssessmentRepositoryInterface $repository
     */
    public function __construct(private AssessmentRepositoryInterface $repository)
    {
    }

    public function index()
    {
        return Inertia::render('Student/Assessments/Index', [
            'subjects' => Subject::all(),
            'assessments' => $this->repository->activeAssessments()
        ]);
    }

    /**
     * @param Assessment $assessment
     * 
     * @return Response
     */
    public function instructions(Assessment $assessment)
    {
        $assessmentStatus = Assessment::NOTSTARTED;
        $assessment = student()->assessments()->wherePivot('assessment_id', $assessment->id)->first();

        if ($assessment && $assessment->status->status === Assessment::INPROGRESS) {
            $assessmentStatus = Assessment::INPROGRESS;
        }

        return Inertia::render('Student/Assessments/Instructions', [
            'assessment' => $assessment,
            'assessmentStatus' => $assessmentStatus,
        ]);
    }

    /**
     * @param Assessment $assessment
     * 
     * @return Response
     */
    public function start(Assessment $assessment)
    {
        // Handle case if not assessment foudn. Should show an error of some 
        $assessment = student()->assessments()->wherePivot('assessment_id', $assessment->id)->first();
        
        $questions = AssessmentQuestionsResource::collection($assessment->multiple_choice_questions->merge($assessment->essay_questions));

        return Inertia::render('Student/Assessments/Start', [
            'questions' => $questions,
            'assessment' => $assessment,
        ]);
    }

    public function store(Request $request, Assessment $assessment)
    {
        $student = Auth::user()->student;
        $assessment_status = $request->status;

        if ($student->statusOfAssessment($assessment) === Assessment::COMPLETED) {
            return Inertia::render('Student/Assessments/AssessmentCompleted', [
                'message' => 'Your assessment has already been submitted.',
                'is_submitted' => true
            ]);
        }

        try {

            if ($assessment_status === Assessment::INPROGRESS) {
                $is_correct = null;
                $studentChoiceId = ['id' => NULL];
    
                if ($request->question['type'] === 'Multiple Choice') {
                    $is_correct = $request->question['student_answer'] == $request->question['correct_answer'];
                    $studentChoiceId = collect($request->question['options'])->where('text', $request->question['student_answer'])->first();
                }
    
                $essay_answer = null;
                if ($request->question['type'] === 'Essay') {
                    $essay_answer = $request->question['student_answer'];
                }
    
                $assessment->answers()->updateOrCreate(['question_id' => $request->question['id']], [
                    'student_choice_id' => $studentChoiceId['id'],
                    'is_correct'        => $is_correct,
                    'essay_answer_text' => $essay_answer,
                    'type'              => $request->question['type'],
                    'obtained_marks'    => $is_correct ? 1 : 0,
                ]);

                $scondsInminute     = 60;
                $timeLeftInMinutes  = $request->timeLeft / $scondsInminute;
                $totalTimeSpent     = $assessment->time_limit_in_minutes - $timeLeftInMinutes;
                $student->assessments()->updateExistingPivot($assessment->id, [
                    'status' => Assessment::INPROGRESS,
                    'time_spent' => $totalTimeSpent
                ]);
    
                return response()->json(['Saved' => true], 200);;
            } else {
    
                $student->assessments()->updateExistingPivot($assessment->id, [
                    'status' => Assessment::COMPLETED,
                    'submitted_at' => now(),
                ]);

                return Inertia::render('Student/Assessments/AssessmentCompleted', [
                    'message' => 'Your assessment have been submitted successfully.',
                    'is_submitted' => false
                ]);
            }

        } catch (\Throwable $th) {
            logError($th);
            return redirect()->back()->with('error', serverErrorMessage());
        }
    }

    public function completed(Request $request)
    {
        return Inertia::render('Student/Assessments/AssessmentCompleted', [
            'message' => 'Your assessment have been submitted successfully.',
        ]);
    }

    /**
     * Search active Assessments.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return response()->json($this->repository->searchAssesments($request), 200);
    }
}
