<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Subject;
use App\Models\StudyGroup;
use App\Models\SchoolClass;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $books_count = Book::count();
        $subjects_count = Subject::count();
        $study_groups_count = StudyGroup::count();
        $school_classes_count = SchoolClass::count();
        $teachers_count = User::role('Teacher')->count();
        $students_count = User::role('Student')->count();

        return Inertia::render('Admin/Dashboard', [
            'teachers_count' => $teachers_count,
            'students_count' => $students_count,
            'study_groups_count' => $study_groups_count,
            'school_classes_count' => $school_classes_count,
            'subjects_count' => $subjects_count,
            'books_count' => $books_count,
        ]);
    }
}
