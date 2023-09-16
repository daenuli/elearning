<?php

namespace App\Http\Controllers\Teacher;

use App\Exports\AssessmentsExport;
use App\Http\Controllers\Controller;
use App\Models\Assessment;
use Maatwebsite\Excel\Facades\Excel;

class ExportAssessmentsubmissionsController extends Controller
{
    public function index(Assessment $assessment)
    {
        return Excel::download(new AssessmentsExport($assessment), 'assessments.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
