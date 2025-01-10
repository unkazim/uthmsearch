<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

// Default route redirects to login
Route::get('/', function (): RedirectResponse {
    return redirect()->route('login');
});

// Authentication routes
Auth::routes();

// Protected routes (example)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Login Routes
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

// Add these routes
Route::post('/register', [App\Http\Controllers\Auth\LoginController::class, 'register'])->name('register');

// Add these routes for registration
Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);