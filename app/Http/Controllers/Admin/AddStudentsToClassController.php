<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddStudentToClassRequest;
use App\Repository\Student\StudentRepositoryInterface;

class AddStudentsToClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SchoolClass $school_class)
    {
        $repository = app(StudentRepositoryInterface::class);
        return Inertia::render('Admin/SchoolClass/AssignStudents', [
            'users' => $repository->index(),
            'school_class' => $school_class,
            'studentIds' => $school_class->students->pluck('id')->toArray()
        ]);
    }

    /**
     * @param App\Http\Requests\AddStudentToClassRequest $request
     * @param App\Models\SchoolClass $school_class
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(AddStudentToClassRequest $request, SchoolClass $school_class)
    {
        $school_class->students()->sync($request->studentIds);

        return redirect()->route('admin.school-class.add-students', $school_class)->with('success', "Students added to {$school_class->name} class successfully.");
    }
}
