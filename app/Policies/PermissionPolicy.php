<?php

namespace App\Policies;

use App\Models\User;

class PermissionPolicy
{
    public function store(User $user) {
        return $user->can('store role');
    }
}
