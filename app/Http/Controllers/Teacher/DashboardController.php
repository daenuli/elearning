<?php

namespace App\Http\Controllers\Teacher;

use Inertia\Inertia;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assignment;

class DashboardController extends Controller
{
    public function index()
    {
        $teacher = auth()->user()->teacher;

        return Inertia::render('Teacher/Dashboard', [
            'lessons_count' => $teacher->lessons->count(),
            'assignments_count' => $teacher->assignments->count(),
            'assessments_count' => $teacher->assessments->count(),
        ]);
    }
}
