<?php

namespace App\Repository\Assignment;

use App\Models\Assignment;
use App\Models\Student;
use Illuminate\Http\Request;

interface AssignmentEvaluationRepositoryInterface {
    
    /**
     * @param Assignment $assignment
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Assignment $assignment);

    /**
     * @param App\Models\Assignment $lesson
     * @param Illuminate\Http\Request $request
     * @param array $data
     * @return bool
     */
    public function store(Request $request, Assignment $assignment);
}
