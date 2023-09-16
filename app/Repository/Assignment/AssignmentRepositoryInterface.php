<?php

namespace App\Repository\Assignment;

use App\Models\Assignment;
use App\Models\Student;
use Illuminate\Http\Request;

interface AssignmentRepositoryInterface {
    
    /**
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function store(Request $request): bool;

    /**
     * @param App\Models\Assignment $lesson
     * @param Illuminate\Http\Request $request
     * @param array $data
     * @return bool
     */
    public function update(Request $request, Assignment $lesson);

    /**
     * @return [type]
     */
    public function activeAssignments();

    /**
     * @param Request $request
     * @return Response
     */
    public function searchAssignments(Request $request);
}
