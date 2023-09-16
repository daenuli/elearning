<?php

namespace App\Http\Controllers\Student;

use Inertia\Inertia;
use App\Models\Lesson;
use App\Http\Controllers\Controller;
use App\Repository\Assessment\AssessmentRepositoryInterface;
use App\Repository\Assignment\AssignmentRepositoryInterface;

class DashboardController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;
     
        $lessons = Lesson::where('class_id', $student->class_id)
            ->whereDate('end_date', '>', now())
            ->get(['id', 'title', 'start_date', 'end_date']);

        $pendingAssignments = app(AssignmentRepositoryInterface::class)->pendingAssignments();
        $pendingAssessment = app(AssessmentRepositoryInterface::class)->pendingAssessment();

        return Inertia::render('Student/Dashboard', [
            'student' => $student,
            'lessons' => $lessons,
            'pendingAssignments' => $pendingAssignments,
            'pendingAssessment' => $pendingAssessment,
        ]);
    }
}
