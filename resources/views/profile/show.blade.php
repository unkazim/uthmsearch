@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Profile Information</h2>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="space-y-6">
                    <!-- Name Section -->
                    <div class="flex justify-between items-start border-b pb-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Name</h3>
                            <p class="mt-1 text-gray-600">{{ $user->name }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Edit Name
                        </a>
                    </div>

                    <!-- Email Section -->
                    <div class="flex justify-between items-start border-b pb-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Email</h3>
                            <p class="mt-1 text-gray-600">{{ $user->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Edit Email
                        </a>
                    </div>

                    <!-- Delete Account Section -->
                    <div class="pt-6 mt-6 border-t border-gray-200">
                        <h3 class="text-xl font-medium text-red-600">Delete Account</h3>
                        <p class="mt-2 text-gray-600">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                        
                        <form method="POST" action="{{ route('profile.destroy') }}" class="mt-4">
                            @csrf
                            @method('DELETE')
                            
                            <div class="mt-4">
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    Confirm your password to delete account
                                </label>
                                <input type="password" 
                                       name="password" 
                                       id="password"
                                       required 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Enter your password">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Delete Account Button with Confirmation -->
                            <div class="mt-6 flex items-center space-x-4">
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200"
                                        onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete Account
                                </button>
                                <button type="button" 
                                        onclick="window.location.href='{{ route('profile.show') }}'"
                                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 border border-gray-300 transition-colors duration-200">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 