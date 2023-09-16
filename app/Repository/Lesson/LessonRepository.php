<?php

namespace App\Repository\Lesson;

use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Events\LessonCreated;
use App\Models\LessonStudent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repository\Lesson\LessonRepositoryInterface;

class LessonRepository implements LessonRepositoryInterface
{

	/**
	 * @return 
	 */
	public function index()
	{
		return Auth::user()->teacher->lessons()->with(['class', 'study_group', 'subject'])->get();
	}

	/**
	 * @param Request $request
	 * 
	 * @return bool
	 */
	public function store(Request $request): bool
	{
		DB::beginTransaction();

		try {

			$lesson = Lesson::create([
				'teacher_id'     => Auth::user()->teacher->id,
				'title'          => $request->title,
				'class_id'       => $request->class_id,
				'study_group_id' => $request->study_group_id,
				'subject_id'     => $request->subject_id,
				'description'    => $request->description,
				'youtube_link'   => $request->youtube_link,
				'start_date'  => $request->date('start_date'),
				'end_date'    => $request->date('end_date'),
			]);

			$students = Student::where('class_id', $request->class_id)
				->where('study_group_id', $request->study_group_id)
				->pluck('id')->all();

			$lesson->students()->sync($students);

			if ($request->hasFile('files')) {
				foreach ($request->file('files') as $file) {
					$fileName = 'Lesson_' . $lesson->title . '.' . $file->extension();
					$lesson->addMedia($file)->usingFileName($fileName)->toMediaCollection('Lesson Files');
				}
			}

			event(new LessonCreated('Test Message'));

			DB::commit();
			return true;
		} catch (\Throwable $th) {
            logError($th);
			DB::rollBack();
			return false;
		}
	}

	/**
	 * @param Request $request
	 * @param Lesson $lesson
	 * 
	 * @return [type]
	 */
	public function update(Request $request, Lesson $lesson)
	{
		try {

			$lesson->update([
				'teacher_id'     => Auth::user()->teacher->id,
				'title'          => $request->form['title'],
				'class_id'       => $request->form['class_id'],
				'study_group_id' => $request->form['study_group_id'],
				'subject_id'     => $request->form['subject_id'],
				'description'    => $request->form['description'],
				'youtube_link'   => $request->form['youtube_link'],
				'start_date'  => $request->date('form.start_date'),
				'end_date'    => $request->date('form.end_date'),
			]);

			$students = Student::where('class_id', $request->form['class_id'])
				->where('study_group_id', $request->form['study_group_id'])
				->pluck('id')->all();
			$lesson->students()->sync($students);


			if ($request->hasFile('form.files')) {
				foreach ($request->file('form.files') as $file) {
					$fileName = 'Lesson_' . $lesson->title . '.' . $file->extension();
					$lesson->addMedia($file)->usingFileName($fileName)->toMediaCollection('Lesson Files');
				}
			}

			return true;
		} catch (\Throwable $th) {
            logError($th);
			return false;
		}
	}

	/**
	 * @param Request $request
	 * @param Lesson $lesson
	 * 
	 * @return [type]   
	 */
	public function activeLessons()
	{
		$student = auth()->user()->student;

		return $student->lessons()->with(['study_group', 'subject'])
			->where('class_id', $student->class_id)
			->whereDate('end_date', '>=', now())
			->orderBy('end_date', 'desc')
			->get()
			->map(function ($lesson) {
				$lesson->files = $lesson->getFiles();
				return $lesson;
			});
	}

	/**
	 * @param Request $request
	 * @param Lesson $lesson
	 * 
	 * @return [type]   
	 */
	public function searchLessons(Request $request)
	{
		$student = auth()->user()->student;

		return $student->lessons()->with(['study_group', 'subject'])
			->where('class_id', $student->class_id)
			->where('subject_id', $request->subject_id)
			->whereDate('end_date', '>=', now())
			->orderBy('end_date', 'desc')
			->get()
			->map(function ($lesson) {
				$lesson->files = $lesson->getFiles();
				return $lesson;
			});
	}

	/**
     * @param Lesson $lesson
     * @return Resposne
     */
    public function reports(Lesson $lesson)
	{
		return LessonStudent::query()
			->select(
				'students.name as student_name',
				'lesson_student.video_progress',
				DB::raw("DATE_FORMAT(lesson_student.access_date, '%M %d, %Y') as formatted_date")
			)
			->join('students', 'students.id', '=', 'lesson_student.student_id')
			->where('lesson_student.lesson_id', $lesson->id)
			->where('students.class_id', $lesson->class_id)
			->where('students.study_group_id', $lesson->study_group_id)
			->get();
		
	}
}
