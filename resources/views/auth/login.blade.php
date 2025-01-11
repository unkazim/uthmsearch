@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <!-- Logo and Title -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">UTHM Housing Search</h1>
            <p class="mt-2 text-gray-600">Welcome back! Please login to your account.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            
            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email Address
                </label>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                    value="{{ old('email') }}"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password
                </label>
                <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                >
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input 
                        id="remember" 
                        name="remember" 
                        type="checkbox" 
                        class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                    >
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                </div>

                <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">
                    Forgot password?
                </a>
            </div>

            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Sign in
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500">
                Register here
            </a>
        </p>
    </div>
</div>
@endsection