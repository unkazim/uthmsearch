@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search Results Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                @if($query)
                    <h2 class="text-2xl font-semibold text-gray-800">
                        Search results for "{{ $query }}"
                    </h2>
                    <p class="text-gray-600 mt-1">
                        {{ $properties->total() }} properties found
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
                    <input type="hidden" name="query" value="{{ $query }}">

                    <!-- Price Range -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Price Range</h3>
                        <div class="space-y-3">
                            <input type="number" name="min_price" placeholder="Min price" 
                                   class="w-full rounded-md border-gray-300"
                                   value="{{ $minPrice }}">
                            <input type="number" name="max_price" placeholder="Max price" 
                                   class="w-full rounded-md border-gray-300"
                                   value="{{ $maxPrice }}">
                        </div>
                    </div>

                    <!-- Bedrooms Filter -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Bedrooms</h3>
                        <select name="bedrooms" class="w-full rounded-md border-gray-300">
                            <option value="">Any</option>
                            @foreach(range(1, 5) as $count)
                                <option value="{{ $count }}" {{ request('bedrooms') == $count ? 'selected' : '' }}>
                                    {{ $count }} {{ Str::plural('bedroom', $count) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort Options -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Sort By</h3>
                        <select name="sort_by" class="w-full rounded-md border-gray-300">
                            <option value="price" {{ $sortBy == 'price' ? 'selected' : '' }}>Price</option>
                            <option value="created_at" {{ $sortBy == 'created_at' ? 'selected' : '' }}>Date</option>
                        </select>
                        <select name="sort_order" class="w-full rounded-md border-gray-300 mt-2">
                            <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </div>

                    <div class="flex flex-col space-y-3">
                        <button type="submit" 
                                class="w-full bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition-colors">
                            Apply Filters
                        </button>

                        <!-- Clear Filters Button -->
                        <a href="{{ route('properties.search', ['query' => $query]) }}" 
                           class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-200 transition-colors text-center border border-gray-300">
                            Clear Filters
                        </a>
                    </div>
                </form>
            </div>

            <!-- Property Listings -->
            <div class="flex-1">
                @if($properties->isEmpty())
                    <div class="text-center py-12 bg-white rounded-lg shadow">
                        <h3 class="text-xl text-gray-600">No properties found matching your criteria.</h3>
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-6">
                        @foreach($properties as $property)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                <div class="flex">
                                    <div class="w-72 h-48">
                                        @if($property->image)
                                            <img src="{{ Storage::url($property->image) }}" 
                                                 alt="{{ $property->title }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                <span class="text-gray-400">No image</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 p-6">
                                        <h3 class="text-xl font-semibold text-gray-800">{{ $property->title }}</h3>
                                        <p class="text-gray-600 mt-2">{{ $property->location }}</p>
                                        <p class="text-2xl font-bold text-primary-600 mt-4">RM {{ number_format($property->price) }}</p>
                                        <div class="mt-4">
                                            <a href="{{ route('properties.show', $property->id) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors">
                                                View Details
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Floating New Search Button -->
                    <a href="{{ route('home') }}" 
                        class="fixed bottom-8 right-8 bg-primary-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-primary-700 transition-colors flex items-center space-x-2 z-50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>New Search</span>
                        </a>
                    <div class="mt-6">
                        {{ $properties->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 