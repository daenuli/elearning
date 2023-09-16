<?php
namespace App\Http\Controllers\Student;

use Inertia\Inertia;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Events\LessonCreated;
use App\Models\LessonStudent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\LessonDiscussionMessage;
use App\Http\Resources\LessonDiscussionResource;

class LessonDiscussionController extends Controller
{
    public function index(Lesson $lesson)
    {
        $user = Auth::user();
        $messages = LessonDiscussionMessage::whereHas('studentLesson', function($query) use ($lesson) {
            $query->where('lesson_id', $lesson->id);
        })->orderBy('created_at', 'asc')->get();

        $models = LessonDiscussionResource::collection($messages);

        return Inertia::render('Student/Lessons/Discussion', [
			'lesson' => $lesson->load('subject'),
            'models' => $models,
            'avatar' => $user->getAvatar(),
            'student' => $user->student->load('user')
		]);
    }

    /**
     * @param Request $request
     * @param Lesson $lesson
     * 
     * @return [type]
     */
    public function store(Request $request, Lesson $lesson)
    {
        $student = Auth::user()->student;

        $model = LessonStudent::where('student_id', $student->id)->where('lesson_id', $lesson->id)->first();

        if (!$model) {
            $model = LessonStudent::create(['student_id' => $student->id, 'lesson_id' => $lesson->id]);
        }

        $model->discussion_messages()->create([
            'message' => $request->message,
        ]);

        event(new LessonCreated(['message' => $request->message, 'studentId' => $student->id]));
    }
}
