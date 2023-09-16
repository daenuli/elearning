<?php

namespace App\Http\Controllers\Teacher;

use Inertia\Inertia;
use App\Models\Subject;
use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Models\AssessmentStudent;
use App\Http\Controllers\Controller;
use App\Http\Requests\GradeAssessmentRequest;
use App\Repository\StudyGroup\StudyGroupRepositoryInterface;
use App\Repository\SchoolClass\SchoolClassRepositoryInterface;
use App\Repository\Assessment\AssessmentEvaluationRepositoryInterface;

class AssessmentEvaluationController extends Controller
{
    /**
     * ClassController constructor
     * @param AssessmentEvaluationRepositoryInterface $repository
     */
    public function __construct(private AssessmentEvaluationRepositoryInterface $repository)
    {
    }

    /**
     * @return [type]
     */
    public function assessments()
    {
        return Inertia::render('Teacher/Evaluation/Assessments/Assessments', [
            'subjects' => Subject::all(),
            'classes' => app(SchoolClassRepositoryInterface::class)->index(),
            'study_groups' => app(StudyGroupRepositoryInterface::class)->index(),
            'assessments' => $this->repository->assessments()
        ]);
    }

    /**
     * @param Assessment $assessment
     * 
     * @return [type]
     */
    function index(Assessment $assessment)
    {
        return Inertia::render('Teacher/Evaluation/Assessments/Index', [
            'students' => $this->repository->index($assessment),
            'assessment' => $assessment->load('subject')
        ]);
    }


    /**
     * @param AssessmentStudent $studentAssessment
     * 
     * @return [type]
     */
    public function review(AssessmentStudent $studentAssessment)
    {
        return Inertia::render('Teacher/Evaluation/Assessments/Review', [
            'questions' => $this->repository->getQuestions($studentAssessment),
            'assessment' => Assessment::find($studentAssessment->assessment_id),
            'studentAssessment'=> $studentAssessment
        ]);
    }

    /**
     * @param Assessment $assessment
     * 
     * @return Response
     */
    public function grade(GradeAssessmentRequest $request, AssessmentStudent $studentAssessment)
    {
        $result =  $this->repository->gradeAssessment($request, $studentAssessment);
        
        if ($result) {
            return redirect()->back()->with('success', 'Assessment graded successfully.');
        }

        return redirect()->back()->with('error', serverErrorMessage());
    }

    /**
     * @param Request $request
     * 
     * @return [type]
     */
    public function search(Request $request)
    {

        $teaccher = auth()->user()->teacher;

        $query = $teaccher->assessments()->with(['study_group', 'class', 'subject'])->where('is_expired', false);

        if ($request->class_id) {
            $query = $query->where('class_id', $request->class_id);
        }

        if ($request->study_group_id) {
            $query = $query->where('study_group_id', $request->study_group_id);
        }

        if ($request->subject_id) {
            $query = $query->where('subject_id', $request->subject_id);
        }

        $assessments = $query->get();

        return response()->json($assessments, 200);
    }
}
