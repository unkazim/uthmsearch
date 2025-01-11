@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <!-- Hero Section with Search -->
    <div class="relative h-screen">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/uthm-building.jpg') }}" alt="UTHM Building" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black opacity-40"></div>
        </div>

        <!-- Search Container -->
        <div class="relative flex flex-col items-center justify-center h-full px-4">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-12 tracking-tight text-center">
                Find Your Perfect Student Housing
            </h2>
            
            <!-- Search Bar -->
            <div class="w-full max-w-2xl">
                <form action="{{ route('properties.search') }}" method="GET" class="flex items-center shadow-xl rounded-lg overflow-hidden">
                    <input 
                        type="text" 
                        name="query"
                        placeholder="Search by location (e.g., Parit Raja, Batu Pahat)" 
                        class="flex-1 px-6 py-4 text-lg text-gray-700 focus:outline-none"
                        value="{{ request('query') }}"
                        required
                    >
                    <button type="submit" class="bg-primary-600 text-white px-8 py-4 h-full text-lg font-medium hover:bg-primary-700 transition-colors duration-200 flex items-center">
                        <span>Search</span>
                    </button>
                </form>
            </div>

            <!-- Quick Filters -->
            <div class="mt-8 flex flex-wrap justify-center gap-4">
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

    <!-- Featured Properties Section
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Featured Properties</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            Add your featured properties here
        </div> -->
    <!-- </div> -->
</div>
@endsection 