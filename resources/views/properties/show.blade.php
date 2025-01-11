@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button - Updated with better styling -->
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ url()->previous() }}" 
               class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors duration-200 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Search Results
            </a>
            
            <!-- Added Home button -->
            <a href="{{ route('home') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors duration-200 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Back to Home
            </a>
        </div>

        <!-- Property Details -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Property Image -->
            <div class="h-96 bg-gray-200">
                @if($property->image)
                    <img src="{{ Storage::url($property->image) }}" 
                         alt="{{ $property->title }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="text-gray-400">No image available</span>
                    </div>
                @endif
            </div>

            <!-- Property Information -->
            <div class="p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $property->title }}</h1>
                        <p class="text-xl text-gray-600 mt-2">{{ $property->location }}, {{ $property->area }}</p>
                    </div>
                    <p class="text-3xl font-bold text-primary-600">RM {{ number_format($property->price, 2) }}</p>
                </div>

                <!-- Property Details Grid -->
                <div class="mt-8 grid grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Property Details</h2>
                        <dl class="grid grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Property Type</dt>
                                <dd class="mt-1 text-sm text-gray-900 capitalize">{{ $property->property_type }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1 text-sm text-gray-900 capitalize">{{ $property->status }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Bedrooms</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $property->bedrooms }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Bathrooms</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $property->bathrooms }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Furnished</dt>
                                <dd class="mt-1 text-sm text-gray-900 capitalize">{{ $property->furnished }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Contact Information</h2>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Contact Person</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $property->contact_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="tel:{{ $property->contact_phone }}" class="text-primary-600 hover:text-primary-700">
                                        {{ $property->contact_phone }}
                                    </a>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="mailto:{{ $property->contact_email }}" class="text-primary-600 hover:text-primary-700">
                                        {{ $property->contact_email }}
                                    </a>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Property Description -->
                <div class="mt-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Description</h2>
                    <p class="text-gray-600 whitespace-pre-line">{{ $property->description }}</p>
                </div>

                @if($property->features)
                    <!-- Property Features -->
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Features</h2>
                        <ul class="grid grid-cols-2 gap-4">
                            @foreach(json_decode($property->features) as $feature)
                                <li class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 