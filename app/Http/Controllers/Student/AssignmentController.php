<?php

namespace App\Http\Controllers\Student;

use Inertia\Inertia;
use App\Models\Subject;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repository\Assignment\AssignmentRepositoryInterface;

class AssignmentController extends Controller
{
    /**
     * ClassController constructor
     * @param AssignmentRepositoryInterface $repository
     */
    public function __construct(private AssignmentRepositoryInterface $repository)
    {
    }

    public function index()
    {
        return Inertia::render('Student/Assignments/Index', [
            'subjects' => Subject::all(),
            'assignments' => $this->repository->activeAssignments()
        ]);
    }

    /**
     * @param Request $request
     * 
     * @return [type]
     */
    public function store(Request $request, Assignment $assignment)
    {
        $student = Auth::user()->student;

        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $extension = $file->extension(); // Determine the file's extension based on the file's MIME type...
                $path = $file->storeAs('public/Assignments/'. $student->id, str_replace(' ', '-', strtolower($assignment->title)).'.'.$extension);
    
                $student->assignments()->updateExistingPivot($assignment->id, [
                    'submitted_at' => now(),
                    'is_completed' => true,
                    'file_path' => $path
                ]);
            }
        } catch (\Throwable $th) {
            logError($th);
            return false;
        }

        return redirect()->route('student.assignments.index')->with('success', 'Assignment submitted successfully');
    }

    /**
     * @param Assignment $assignment
     * 
     * @return [type]
     */
    public function show(Assignment $assignment)
    {
        return Inertia::render('Student/Assignments/Show', [
            'files' => $assignment->getFiles(),
            'assignment' => $assignment->load(['class', 'study_group'])
        ]);
    }

    /**
     * Search active assignmetnts.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return response()->json($this->repository->searchAssignments($request), 200);
    }
}
