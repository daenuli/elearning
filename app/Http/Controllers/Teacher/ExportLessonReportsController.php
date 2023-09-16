<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Exports\LessonRportsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportLessonReportsController extends Controller
{
    public function index(Lesson $lesson)
    {
        return Excel::download(new LessonRportsExport($lesson), 'Lesson Reports.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
