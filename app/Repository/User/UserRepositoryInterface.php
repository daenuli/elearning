<?php

namespace App\Repository\User;

use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface {
    
    /**
     * @param string $role
     */
    public function getUsersByRole($role): Collection;
}
