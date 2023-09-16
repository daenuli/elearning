<?php

namespace App\Http\Controllers\Student;

use Inertia\Inertia;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use App\Repository\Lesson\LessonRepositoryInterface;

class LessonController extends Controller
{
	/**
	 * ClassController constructor
	 * @param App\Repository\Custom\LessonRepositoryInterface $repository
	 */
	public function __construct(private LessonRepositoryInterface $repository)
	{
	}

	public function index()
	{
		return Inertia::render('Student/Lessons/Index', [
			'subjects' => Subject::all(),
			'lessons' => $this->repository->activeLessons()
		]);
	}

	/**
	 * @param Lesson $lesson
	 * 
	 * @return Response
	 */
	public function show(Lesson $lesson)
	{
		$student = Auth::user()->student;

		$lesson_student = $student->getLessonVideoCompletionPercentage($lesson);
		$video_progress = 0;
		
		if ($lesson_student) {
			$video_progress = $lesson_student->video_progress;
		}

		// Update access date only if it is null initially.
		$existingPivot = $lesson->students()->where('student_id', $student->id)->first();
		if ($existingPivot && is_null($existingPivot->access_date)) {
			$lesson->students()->updateExistingPivot($student->id, [
				'access_date' => now(),
			]);
		}

		return Inertia::render('Student/Lessons/Show', [
			'files' => $lesson->getFiles(),
			'video_progress' => $video_progress,
			'lesson' => $lesson->load(['class', 'study_group'])
		]);
	}

	/**
	 * @param Request $request
	 * @param Lesson $lesson
	 * 
	 * @return Response
	 */
	public function saveProggress(Request $request, Lesson $lesson)
	{
		$student = Auth::user()->student;

		$model 			= $student->lessons()->where('lesson_id', $lesson->id)->first();
		$video_progress = $request->progress * 0.4;

		$student->lessons()->sync([$lesson->id => ['video_progress' => $request->progress]]);

		$model->pivot->update([
			'total_progress' => $model->pivot->total_progress + $video_progress
		]);

		return response()->json(['Successfully saved!'], 200);
	}

	    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return response()->json($this->repository->searchLessons($request), 200);
    }
}