<?php

namespace App\Http\Controllers\Teacher;

use Inertia\Inertia;
use App\Models\Subject;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\AssignmentStudent;
use App\Http\Controllers\Controller;
use App\Repository\StudyGroup\StudyGroupRepositoryInterface;
use App\Repository\SchoolClass\SchoolClassRepositoryInterface;
use App\Repository\Assignment\AssignmentEvaluationRepositoryInterface;

class AssignmentEvaluationController extends Controller
{
    /**
     * ClassController constructor
     * @param AssignmentEvaluationRepositoryInterface $repository
     */
    public function __construct(private AssignmentEvaluationRepositoryInterface $repository)
    {
    }

    /**
     * @return [type]
     */
    public function assignments()
    {
        $teacher = auth()->user()->teacher;

        $assignments = $teacher->assignments()->with(['study_group', 'class', 'subject'])->where('is_expired', false)->get();

        return Inertia::render('Teacher/Evaluation/Assignments/Assignments', [
            'subjects' => Subject::all(),
            'classes' => app(SchoolClassRepositoryInterface::class)->index(),
            'study_groups' => app(StudyGroupRepositoryInterface::class)->index(),
            'assignments' => $assignments
        ]);
    }

    /**
     * @param Assignment $assignment
     * 
     * @return [type]
     */
    function index(Assignment $assignment)
    {
        return Inertia::render('Teacher/Evaluation/Assignments/Index', [
            'students' => $this->repository->index($assignment),
            'assignment' => $assignment->load('subject')
        ]);
    }

    /**
     * @param Assignment $assignment
     * 
     * @return [type]
     */
    public function grade(Request $request, AssignmentStudent $studentAssignment)
    {
        $studentAssignment->update([
            'marks_obtained' => $request->marks,
            'is_graded' => true,
        ]);

        return redirect()->route('teacher.evaluation.student.assignments', $studentAssignment->assignment_id)->with('success', 'Assignment graded successfully.');
    }

    /**
     * @param Request $request
     * 
     * @return [type]
     */
    public function search(Request $request)
    {
        $teacher = auth()->user()->teacher;

        $query = $teacher->assignments()->with(['study_group', 'class', 'subject'])->where('is_expired', false);

        if ($request->class_id) {
            $query = $query->where('class_id', $request->class_id);
        }

        if ($request->study_group_id) {
            $query = $query->where('study_group_id', $request->study_group_id);
        }

        if ($request->subject_id) {
            $query = $query->where('subject_id', $request->subject_id);
        }

        $assignments = $query->get();

        return response()->json($assignments, 200);
    }
}