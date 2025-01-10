@extends('layouts.app')

@php
use Illuminate\Support\Facades\Route;
@endphp

@section('content')
<div class="bg-white rounded-lg shadow-xl p-8">
    <!-- Logo or Title -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800">UTHMSearch</h1>
        <p class="text-gray-600 mt-2">Welcome back!</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Email Address') }}
            </label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                autofocus
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter your email"
            >
            @error('email')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Password') }}
            </label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter your password"
            >
            @error('password')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 mb-4">
            {{ __('Login') }}
        </button>

        <!-- Register Link -->
        <div class="text-center">
            <span class="text-gray-600">Don't have an account?</span>
            <a href="{{ route('register') }}" class="ml-1 text-blue-600 hover:text-blue-800">
                {{ __('Register now') }}
            </a>
        </div>
    </form>
</div>
@endsection
