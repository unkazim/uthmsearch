<?php

namespace App\Services;

use App\Models\User;

class AdminService
{
    public function getAdmin()
    {
        return User::where('is_admin', true)->first();
    }
} 