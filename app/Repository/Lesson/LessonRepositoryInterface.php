<?php

namespace App\Repository\Lesson;

use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Http\Request;

interface LessonRepositoryInterface {
    
    /**
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function store(Request $request): bool;

    /**
     * @param App\Models\Lesson $lesson
     * @param Illuminate\Http\Request $request
     * @param array $data
     * @return bool
     */
    public function update(Request $request, Lesson $lesson);

    /**
     * @return Resposne
     */
    public function activeLessons();

    /**
     * @param Request $request
     * @return Resposne
     */
    public function searchLessons(Request $request);

    /**
     * @param Lesson $lesson
     * @return Resposne
     */
    public function reports(Lesson $lesson);
}
