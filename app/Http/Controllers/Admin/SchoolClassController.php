<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SubmitSchoolClassRequest;
use App\Http\Requests\Admin\StoreStudentRequest;
use App\Repository\User\UserRepositoryInterface;
use App\Http\Requests\Admin\UpdateStudentRequest;
use App\Repository\SchoolClass\SchoolClassRepositoryInterface;

class SchoolClassController extends Controller
{
    /**
     * SchoolClassController constructor
     * @param App\Repository\User\SchoolClassRepositoryInterface $repository
     */
    public function __construct(private SchoolClassRepositoryInterface $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repository = app(SchoolClassRepositoryInterface::class);
        return Inertia::render('Admin/SchoolClass/Index', [
            'school_classes' => $repository->index()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubmitSchoolClassRequest $request)
    {
        SchoolClass::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.school-classes.index')->with('success', 'Class created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolClass $SchoolClass)
    {
        return Inertia::render('Admin/SchoolClass/Show', [
            'student' => $SchoolClass->load('user'),
            'avatar' => $SchoolClass->user->getAvatar()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolClass  $SchoolClass
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolClass $SchoolClass)
    {
        return Inertia::render('Admin/SchoolClass/Edit', [
            'student' => $SchoolClass->load('user')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolClass  $SchoolClass
     * @return \Illuminate\Http\Response
     */
    public function update(SubmitSchoolClassRequest $request, SchoolClass $school_class)
    {
        $school_class->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.school-classes.index')->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolClass $school_class
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolClass $school_class)
    {
        $school_class->delete();

        return redirect()->route('admin.school-classes.index')->with('success', 'Class deleted successfully.');
    }
}
