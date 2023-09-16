<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TeachersExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportTeacherController extends Controller
{
    public function index()
    {
        return Excel::download(new TeachersExport, 'teachers.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}