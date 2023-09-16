<?php

namespace App\Repository\Teacher;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;

interface TeacherRepositoryInterface {
    
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
     * @param App\Models\Teacher $teacher
     * @param Illuminate\Http\Request $request
     * @param array $data
     * @return bool
     */
    public function update(Request $request, Teacher $teacher);

    /**
     * @param User $user
     * @return void
     */
    public function delete(User $user);
}
