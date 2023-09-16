<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Subject;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubmitSubjectRequest;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Subject/Index', [
            'subjects' => Subject::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubmitSubjectRequest $request)
    {
        Subject::create([
            'title' => $request->title
        ]);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $studyGroup
     * @return \Illuminate\Http\Response
     */
    public function update(SubmitSubjectRequest $request, Subject $subject)
    {
        $subject->update([
            'title' => $request->title
        ]);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
