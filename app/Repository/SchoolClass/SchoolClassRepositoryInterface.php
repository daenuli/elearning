<?php

namespace App\Repository\SchoolClass;

use App\Models\Student;
use Illuminate\Http\Request;

interface SchoolClassRepositoryInterface {

    /**
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function index();

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
