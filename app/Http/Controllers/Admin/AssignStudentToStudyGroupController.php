<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Student;
use App\Models\StudyGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Student\StudentRepositoryInterface;
use App\Http\Requests\AssignStudentToStudyGroupRequest;

class AssignStudentToStudyGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StudyGroup $study_group)
    {
        $repository = app(StudentRepositoryInterface::class);
        return Inertia::render('Admin/StudyGroup/AssignStudents', [
            'users' => $repository->index(),
            'study_group' => $study_group,
            'studentIds' => $study_group->students->pluck('id')->toArray()
        ]);
    }

    /**
     * @param App\Http\Requests\AssignStudentToStudyGroupRequest $request
     * @param App\Models\StudyGroup $study_group
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(AssignStudentToStudyGroupRequest $request, StudyGroup $study_group)
    {
        $study_group->students()->sync($request->studentIds);

        return redirect()->route('admin.study-group.assign-students', $study_group)->with('success', "Students added to {$study_group->name} group successfully.");
    }
}
