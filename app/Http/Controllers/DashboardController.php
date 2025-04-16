<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProperties = Property::count();
        $availableProperties = Property::where('status', 'available')->count();
        $rentedProperties = Property::where('status', 'rented')->count();

        return view('admin.dashboard', compact('totalProperties', 'availableProperties', 'rentedProperties'));
    }
}