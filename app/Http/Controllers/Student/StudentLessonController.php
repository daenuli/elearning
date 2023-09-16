<?php

namespace App\Http\Controllers\Student;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentLessonController extends Controller
{
    public function store(Request $request, Lesson $lesson)
    {
        $user = Auth::user();
        $user->student->lessons()->sync([$lesson->id => ['video_progress' => $request->progress]]);

        return response()->json(['Successfully saved!'], 200);
    }
}
