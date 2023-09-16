<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Imports\StudentImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportRequest;
use Maatwebsite\Excel\Facades\Excel;

class ImportStudentsController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Students/Import');
    }

    public function store(ImportRequest $request)
    {
        try {
            Excel::import(new StudentImport, $request->file('file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
			return redirect(route('admin.import.students.index'))->with('import_error', $failures);
        }

        return redirect(route('admin.students.index'))->with('success', 'Students imported successfully');
    }
}
