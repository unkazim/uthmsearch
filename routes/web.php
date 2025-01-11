<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;

// Default route redirects to login
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.properties.index');
        }
        return redirect()->route('home');
    }
    return redirect()->route('login');
})->name('welcome');

// Authentication routes
Auth::routes();

// Protected routes (example)
Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

// Login Routes
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

// Add these routes
Route::post('/register', [App\Http\Controllers\Auth\LoginController::class, 'register'])->name('register');

// Add these routes for registration
Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('/properties/search', [PropertyController::class, 'search'])
    ->name('properties.search')
    ->middleware(['auth']);

Route::get('/properties/{property}', [PropertyController::class, 'show'])
    ->name('properties.show')
    ->middleware(['auth']);

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('properties', AdminPropertyController::class);
    });
});