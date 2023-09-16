<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStudentRequest;
use App\Repository\User\UserRepositoryInterface;
use App\Http\Requests\Admin\UpdateStudentRequest;
use App\Repository\Student\StudentRepositoryInterface;
use App\Repository\StudyGroup\StudyGroupRepositoryInterface;
use App\Repository\SchoolClass\SchoolClassRepositoryInterface;

class StudentController extends Controller
{
    /**
     * StudentController constructor
     * @param App\Repository\User\StudentRepositoryInterface $repository
     */
    public function __construct(private StudentRepositoryInterface $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Students/Index', [
            'users' => $this->repository->index()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Students/Create', [
            'study_groups'  => app(StudyGroupRepositoryInterface::class)->index(),
            'classes'       => app(SchoolClassRepositoryInterface::class)->index(),
            'users'         => app(UserRepositoryInterface::class)->getUsersByRole('Teacher'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $result = $this->repository->store($request);

        if ($result) {
            return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
        }

        return redirect()->route('admin.students.index')->with('error', serverErrorMessage());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return Inertia::render('Admin/Students/Show', [
            'student' => $student->load('user', 'school_class', 'study_group'),
            'avatar' => $student->user->getAvatar()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return Inertia::render('Admin/Students/Edit', [
            'student'       => $student->load('user'),
            'classes'       => app(SchoolClassRepositoryInterface::class)->index(),
            'study_groups'  => app(StudyGroupRepositoryInterface::class)->index(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $result = $this->repository->update($request, $student);

        if ($result) {
            return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
        }

        return redirect()->route('admin.students.index')->with('error', serverErrorMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student)
    {
        // get all lesson_student pivot records
        $pivots = $student->student->pivots;

        $student->delete();

        // delete all pivot records
        foreach ($pivots as $pivot) {
            $pivot->delete();
        }

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}
