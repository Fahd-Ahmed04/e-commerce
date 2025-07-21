<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminPolice
{
    public function admin(User $user, Admin $admin)
    {
        return $admin->user->is($user);
    }
}
