<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Teacher;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTeacherRequest;
use App\Http\Requests\Admin\UpdateTeacherRequest;
use App\Repository\Teacher\TeacherRepositoryInterface;

class TeacherController extends Controller
{
    /**
     * TeacherController constructor
     * @param App\Repository\Teacher\TeacherRepositoryInterface $repository
     */
    public function __construct(private TeacherRepositoryInterface $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Teachers/Index', [
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
        return Inertia::render('Admin/Teachers/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        $result = $this->repository->store($request);

        if ($result) {
            return redirect()->route('admin.teachers.index')->with('success', 'Teacher created successfully.');
        }

        return redirect()->route('admin.teachers.index')->with('error', serverErrorMessage());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return Inertia::render('Admin/Teachers/Show', [
            'teacher' => $teacher->load('user'),
            'avatar' => $teacher->user->getAvatar()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        return Inertia::render('Admin/Teachers/Edit', [
            'teacher' => $teacher->load('user')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $result = $this->repository->update($request, $teacher);

        if ($result) {
            return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
        }

        return redirect()->route('admin.teachers.index')->with('error', serverErrorMessage());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $teacher)
    {
        $this->repository->delete($teacher);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
