<?php

namespace App\Http\Controllers\Teacher;

use Inertia\Inertia;
use App\Models\Subject;
use App\Models\Assignment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Repository\Assignment\AssignmentRepositoryInterface;
use App\Repository\StudyGroup\StudyGroupRepositoryInterface;
use App\Repository\SchoolClass\SchoolClassRepositoryInterface;

class AssignmentController extends Controller
{
    /**
     * AssignmentController constructor
     * @param App\Repository\Assignment\AssignmentRepositoryInterface $repository
     */
    public function __construct(private AssignmentRepositoryInterface $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Teacher/Assignments/Index', [
            'assignments' => $this->repository->index()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Teacher/Assignments/Create', [
            'subjects' => Subject::all(),
            'classes' => app(SchoolClassRepositoryInterface::class)->index(),
            'study_groups' => app(StudyGroupRepositoryInterface::class)->index(),
        ]);
    }

    /**
     * @param StoreAssignmentsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssignmentRequest $request)
    {
        $result = $this->repository->store($request);

        if ($result) {
            return redirect()->route('teacher.assignments.index')->with('success', 'Assignment created successfully.');
        }

        return redirect()->route('teacher.assignments.index')->with('error', serverErrorMessage());
    }

    /**
     * @param Assignment $assignment
     * 
     * @return \Illuminate\Http\Response
     */
    public function publish(Assignment $assignment)
    {
        $result = $this->repository->publish($assignment);
        
        if ($result) {
            return redirect()->route('teacher.assignments.index')->with('success', 'Assignment published successfully.');
        }

        return redirect()->route('teacher.assignments.index')->with('error', serverErrorMessage());
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Assignment $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        return Inertia::render('Teacher/Assignments/Show', [
            'files' => $assignment->getFiles(),
            'assignment' => $assignment->load(['class', 'study_group', 'subject:id,title'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Assignment $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        if ($assignment->isPublished()) {
            return redirect()->route('teacher.assignments.index')->with('warning', 'You cannot update the assignment once it has been published.');
        }

        return Inertia::render('Teacher/Assignments/Edit', [
            'assignment' => $assignment,
            'subjects' => Subject::all(),
            'classes' => app(SchoolClassRepositoryInterface::class)->index(),
            'study_groups' => app(StudyGroupRepositoryInterface::class)->index(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Assignment $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssignmentRequest $request, Assignment $assignment)
    {
        $result = $this->repository->update($request, $assignment);

        if ($result) {
            return redirect()->route('teacher.assignments.show', $assignment)->with('success', 'Assignment updated successfully.');
        }

        return redirect()->route('teacher.assignments.index')->with('error', serverErrorMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Assignment $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        if ($assignment->isPublished()) {
            return redirect()->route('teacher.assignments.index')->with('warning', 'You cannot delete the assignment once it has been published.');
        }

        $assignment->delete();
        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment deleted successfully.');
    }
}
