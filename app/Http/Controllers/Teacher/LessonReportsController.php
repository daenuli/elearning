<?php

namespace App\Http\Controllers\Teacher;

use Inertia\Inertia;
use App\Models\Lesson;
use App\Http\Controllers\Controller;
use App\Repository\Lesson\LessonRepositoryInterface;

class LessonReportsController extends Controller
{
    /**
     * StudentController constructor
     * @param App\Repository\Lesson\LessonRepositoryInterface $repository
     */
    public function __construct(private LessonRepositoryInterface $repository)
    {
    }

    public function index(Lesson $lesson)
    {
        return Inertia::render('Teacher/Lessons/Reports', [
            'lesson' => $lesson->load('subject'),
            'reports' => $this->repository->reports($lesson)
        ]);
    }
}
