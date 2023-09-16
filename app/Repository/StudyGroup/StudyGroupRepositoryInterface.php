<?php

namespace App\Repository\StudyGroup;

use App\Models\Student;
use Illuminate\Http\Request;

interface StudyGroupRepositoryInterface {
    
    /**
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function store(Request $request): bool;

    /**
     * @param App\Models\Student $student
     * @param Illuminate\Http\Request $request
     * @param array $data
     * @return bool
     */
    public function update(Request $request, Student $student);
}
