<?php

namespace App\Services;

use App\Models\Property;

class AdminService
{
    public function getPropertyStats()
    {
        return [
            'total' => Property::count(),
            'available' => Property::where('status', 'available')->count(),
            'rented' => Property::where('status', 'rented')->count(),
        ];
    }
} 