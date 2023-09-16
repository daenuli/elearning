<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StudentsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportStudentController extends Controller
{
    public function index()
    {
        return Excel::download(new StudentsExport, 'students.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}