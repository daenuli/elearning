<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\StudyGroup;
use App\Http\Controllers\Controller;
use App\Repository\User\UserRepositoryInterface;
use App\Http\Requests\Admin\SubmitStudyGroupRequest;
use App\Repository\StudyGroup\StudyGroupRepositoryInterface;

class StudyGroupController extends Controller
{
    /**
     * StudyGroupController constructor
     * @param App\Repository\User\StudyGroupRepositoryInterface $repository
     */
    public function __construct(private StudyGroupRepositoryInterface $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repository = app(StudyGroupRepositoryInterface::class);
        return Inertia::render('Admin/StudyGroup/Index', [
            'study_groups' => $repository->index()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $repository = app(UserRepositoryInterface::class);

        return Inertia::render('Admin/StudyGroup/Create', [
            'users' => $repository->getUsersByRole('Teacher')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubmitStudyGroupRequest $request)
    {
        StudyGroup::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.study-groups.index')->with('success', 'Study Group created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(StudyGroup $studyGroup)
    {
        return Inertia::render('Admin/StudyGroup/Show', [
            'student' => $studyGroup->load('user'),
            'avatar' => $studyGroup->user->getAvatar()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudyGroup  $studyGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(StudyGroup $studyGroup)
    {
        return Inertia::render('Admin/StudyGroup/Edit', [
            'student' => $studyGroup->load('user')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudyGroup  $studyGroup
     * @return \Illuminate\Http\Response
     */
    public function update(SubmitStudyGroupRequest $request, StudyGroup $study_group)
    {
        $study_group->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.study-groups.index')->with('success', 'Study Group updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudyGroup $study_group
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudyGroup $study_group)
    {
        $study_group->delete();

        return redirect()->route('admin.study-groups.index')->with('success', 'Study Group deleted successfully.');
    }
}
