<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    public function userRole(User $user)
    {
        return $user->can('set role');
    }

    public function store(User $user) {
        return $user->can('store role');
    }
}
