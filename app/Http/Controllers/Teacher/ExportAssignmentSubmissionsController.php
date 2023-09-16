<?php

namespace App\Http\Controllers\Teacher;

use App\Exports\AssignmentsExport;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Maatwebsite\Excel\Facades\Excel;

class ExportAssignmentSubmissionsController extends Controller
{
    public function index(Assignment $assignment)
    {
        return Excel::download(new AssignmentsExport($assignment), 'assignments.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
