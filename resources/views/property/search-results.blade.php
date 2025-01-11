@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="min-h-screen bg-gray-50 pt-16">
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search Results Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                @if($searchQuery)
                    <h2 class="text-2xl font-semibold text-gray-800">
                        Search results for "{{ $searchQuery }}"
                    </h2>
                    <p class="text-gray-600 mt-1">
                        {{ $properties->count() }} properties found
                    </p>
                @else
                    <h2 class="text-2xl font-semibold text-gray-800">
                        All Properties
                    </h2>
                @endif
            </div>

            <!-- Back to Search Button -->
            <a href="{{ route('home') }}" 
               class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Search
            </a>
        </div>

        <div class="flex gap-8">
            <!-- Filters Sidebar -->
            <div class="w-64 flex-shrink-0">
                <form action="{{ route('properties.search') }}" method="GET" class="bg-white rounded-lg shadow p-6">
                    <!-- Preserve search query -->
                    <input type="hidden" name="query" value="{{ request('query') }}">

                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Sort by</h2>
                    <select name="sort" class="w-full mb-6 rounded-md border-gray-300" onchange="this.form.submit()">
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price (lowest first)</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price (highest first)</option>
                    </select>

                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Price Range</h2>
                    <div class="space-y-3">
                        <input 
                            type="number" 
                            name="min_price" 
                            placeholder="Min price" 
                            class="w-full rounded-md border-gray-300"
                            value="{{ request('min_price') }}"
                        >
                        <input 
                            type="number" 
                            name="max_price" 
                            placeholder="Max price" 
                            class="w-full rounded-md border-gray-300"
                            value="{{ request('max_price') }}"
                        >
                    </div>

                    <h2 class="text-lg font-semibold text-gray-800 mt-6 mb-4">Bedrooms</h2>
                    <select name="bedrooms" class="w-full rounded-md border-gray-300">
                        <option value="">Any</option>
                        @foreach(range(1, 5) as $count)
                            <option value="{{ $count }}" {{ request('bedrooms') == $count ? 'selected' : '' }}>
                                {{ $count }} {{ Str::plural('bedroom', $count) }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="w-full mt-6 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
                        Apply Filters
                    </button>

                    @if(request()->anyFilled(['min_price', 'max_price', 'bedrooms', 'sort']))
                        <a href="{{ route('properties.search', ['query' => request('query')]) }}" 
                           class="block w-full mt-3 text-center text-sm text-blue-500 hover:text-blue-700">
                            Clear filters
                        </a>
                    @endif
                </form>
            </div>

            <!-- Property Listings -->
            <div class="flex-1">
                @foreach($properties as $property)
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6 hover:shadow-lg transition-shadow">
                    <div class="flex">
                        <div class="w-72 h-48">
                            <img src="{{ $property['image'] }}" alt="{{ $property['title'] }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $property['title'] }}</h3>
                                    <p class="text-gray-600 mb-2">{{ $property['location'] }}</p>
                                </div>
                                <div class="text-2xl font-bold text-gray-800">
                                    RM {{ number_format($property['price']) }}
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-6 mt-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    <span>{{ $property['bedrooms'] }} Bedrooms</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    <span>{{ $property['bathrooms'] }} Bathrooms</span>
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('properties.show', $property['id']) }}" class="inline-block bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition-colors">
                                    View property
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                @if($properties->isEmpty())
                    <div class="text-center py-12">
                        <h3 class="text-xl text-gray-600">No properties found matching your search.</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Floating New Search Button -->
    <a href="{{ route('home') }}" 
       class="fixed bottom-8 right-8 bg-primary-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-primary-700 transition-colors flex items-center space-x-2 z-50">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <span>New Search</span>
    </a>
</div>
@endsection 