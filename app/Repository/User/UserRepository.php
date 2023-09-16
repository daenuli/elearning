<?php

namespace App\Repository\User;

use App\Models\User;
use App\Repository\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface {

    /**
     * @param string $role
     */
    public function getUsersByRole($role): Collection
    {
        return User::role($role)->with(strtolower($role))->get();
    }
}