<?php

namespace App\Repository\Student;

use App\Models\Student;
use Illuminate\Http\Request;

interface StudentRepositoryInterface {

    /**
     * @return Illuminate\Http\Resources\Json\AnonymousResourceCollection
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
