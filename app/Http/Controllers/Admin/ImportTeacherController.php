<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Imports\TeachersImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportRequest;
use Maatwebsite\Excel\Facades\Excel;

class ImportTeacherController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Teachers/Import');
    }

    public function store(ImportRequest $request)
    {
        try {
            $result = Excel::import(new TeachersImport, $request->file('file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
			return redirect(route('admin.import.teachers.index'))->with('import_error', $failures);
        }

        return redirect(route('admin.teachers.index'))->with('success', 'Teachers imported successfully');
    }
}