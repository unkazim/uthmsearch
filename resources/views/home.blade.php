@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <h1 class="text-3xl font-bold text-gray-800">UTHMSearch</h1>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">My Favorites</a>
                    
                    <!-- Profile Dropdown -->
                    <div class="relative ml-3 group">
                        <button type="button" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                            <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Profile">
                            <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                        </button>
                        <!-- Dropdown Menu -->
                        <div class="hidden group-hover:block absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Search -->
    <div class="relative h-screen">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/uthm-building.jpg') }}" alt="UTHM Building" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black opacity-40"></div>
        </div>

        <!-- Search Container -->
        <div class="relative flex flex-col items-center justify-center h-full px-4">
            <h2 class="text-5xl font-bold text-white mb-8 tracking-tight">
                Find Your Perfect Student Housing
            </h2>
            
            <!-- Search Bar -->
            <div class="w-full max-w-3xl">
                <form action="{{ route('properties.search') }}" method="GET" class="flex shadow-xl rounded-lg overflow-hidden">
                    <input 
                        type="text" 
                        name="query"
                        placeholder="Search by location (e.g., Parit Raja, Batu Pahat)" 
                        class="flex-1 px-6 py-4 text-lg text-gray-700 focus:outline-none"
                        value="{{ request('query') }}"
                    >
                    <button type="submit" class="bg-blue-600 text-white px-8 py-4 text-lg font-medium hover:bg-blue-700 transition-colors duration-200">
                        Search
                    </button>
                </form>
            </div>

            <!-- Quick Filters -->
            <div class="mt-8 flex justify-center space-x-6">
                <a href="{{ route('properties.search', ['query' => 'Parit Raja']) }}" 
                   class="bg-white/20 text-white px-6 py-3 rounded-full hover:bg-white/30 transition-colors duration-200 text-lg font-medium">
                    Parit Raja
                </a>
                <a href="{{ route('properties.search', ['query' => 'Batu Pahat']) }}" 
                   class="bg-white/20 text-white px-6 py-3 rounded-full hover:bg-white/30 transition-colors duration-200 text-lg font-medium">
                    Batu Pahat
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 