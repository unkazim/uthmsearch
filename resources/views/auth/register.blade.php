@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-xl p-8">
    <!-- Logo or Title -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800">UTHM Housing Search</h1>
        <p class="text-gray-600 mt-2">Create your account</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Name') }}
            </label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter your name"
            >
            @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

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
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Create a password"
            >
            @error('password')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Confirm Password') }}
            </label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Confirm your password"
            >
        </div>

        <!-- Register Button -->
        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 mb-4">
            {{ __('Register') }}
        </button>

        <!-- Login Link -->
        <div class="text-center">
            <span class="text-gray-600">Already have an account?</span>
            <a href="{{ route('login') }}" class="ml-1 text-blue-600 hover:text-blue-800">
                {{ __('Login here') }}
            </a>
        </div>
    </form>
</div>
@endsection 