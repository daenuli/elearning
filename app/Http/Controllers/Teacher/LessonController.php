<?php

namespace App\Http\Controllers\Teacher;

use Inertia\Inertia;
use App\Models\Lesson;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Repository\Lesson\LessonRepositoryInterface;
use App\Repository\StudyGroup\StudyGroupRepositoryInterface;
use App\Repository\SchoolClass\SchoolClassRepositoryInterface;

class LessonController extends Controller
{
    /**
     * StudentController constructor
     * @param App\Repository\Lesson\LessonRepositoryInterface $repository
     */
    public function __construct(private LessonRepositoryInterface $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Teacher/Lessons/Index', [
            'lessons' => $this->repository->index()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Teacher/Lessons/Create', [
            'subjects' => Subject::all(),
            'classes' => app(SchoolClassRepositoryInterface::class)->index(),
            'study_groups' => app(StudyGroupRepositoryInterface::class)->index(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLessonRequest $request)
    {
        $result = $this->repository->store($request);

        if ($result) {
            return redirect()->route('teacher.lessons.index')->with('success', 'Lesson created successfully.');
        }

        return redirect()->route('teacher.lessons.index')->with('error', serverErrorMessage());
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        return Inertia::render('Teacher/Lessons/Show', [
            'files' => $lesson->getFiles(),
            'lesson' => $lesson->load(['class', 'study_group', 'subject:id,title'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        return Inertia::render('Teacher/Lessons/Edit', [
            'lesson' => $lesson,
            'subjects' => Subject::all(),
            'classes' => app(SchoolClassRepositoryInterface::class)->index(),
            'study_groups' => app(StudyGroupRepositoryInterface::class)->index(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $result = $this->repository->update($request, $lesson);

        if ($result) {
            return redirect()->route('teacher.lessons.show', $lesson)->with('success', 'Lesson updated successfully.');
        }


        return redirect()->route('teacher.lessons.index')->with('error', serverErrorMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('teacher.lessons.index')->with('success', 'Lesson deleted successfully.');
    }
}
