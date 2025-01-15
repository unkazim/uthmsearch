<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $totalProperties = Property::count();
        $availableProperties = Property::where('status', 'available')->count();
        $rentedProperties = Property::where('status', 'rented')->count();

        return view('admin.dashboard', compact('totalProperties', 'availableProperties', 'rentedProperties'));
    }
} 