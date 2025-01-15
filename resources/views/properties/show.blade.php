@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button Section -->
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ session('search_results_url', route('properties.search')) }}" 
               class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors duration-200 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Search Results
            </a>
            
            <a href="{{ route('home') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors duration-200 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Home
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

                <!-- Review Section -->
                <div class="mt-8">
                    <h3 class="text-2xl font-bold mb-4">Reviews</h3>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Review Form -->
                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <h4 class="text-lg font-semibold mb-4">Write a Review</h4>
                        @auth
                            <form action="{{ route('reviews.store', $property) }}" method="POST">
                                @csrf
                                
                                <!-- Star Rating -->
                                <div class="mb-6">
                                    <label class="block text-lg font-medium text-gray-700 mb-3">Rating</label>
                                    <div class="flex items-center space-x-3">
                                        <input type="hidden" name="rating" id="selected_rating" value="" required>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <button type="button" 
                                                class="star-rating p-2 focus:outline-none" 
                                                data-rating="{{ $i }}"
                                                onclick="selectRating({{ $i }})">
                                                <svg class="w-12 h-12 text-gray-300 hover:text-yellow-400 transition-colors duration-200" 
                                                     fill="currentColor" 
                                                     viewBox="0 0 24 24">
                                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                </svg>
                                            </button>
                                        @endfor
                                    </div>
                                    @error('rating')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                                    <textarea id="comment" 
                                            name="comment" 
                                            rows="4" 
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            required></textarea>
                                    @error('comment')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex space-x-4">
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                                        Submit Review
                                    </button>
                                    <a href="{{ url()->previous() }}" 
                                       class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 border border-gray-300 transition-colors duration-200">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        @else
                            <p class="text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-600 hover:underline">login</a> to write a review.</p>
                        @endauth
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const stars = document.querySelectorAll('.star-rating');
                            let selectedRating = 0;

                            function updateStars(rating, permanent = false) {
                                stars.forEach((star, index) => {
                                    const starSvg = star.querySelector('svg');
                                    if (index < rating) {
                                        starSvg.classList.remove('text-gray-300');
                                        starSvg.classList.add('text-yellow-400');
                                    } else {
                                        if (!permanent || index >= selectedRating) {
                                            starSvg.classList.remove('text-yellow-400');
                                            starSvg.classList.add('text-gray-300');
                                        }
                                    }
                                });

                                if (permanent) {
                                    selectedRating = rating;
                                    document.getElementById('selected_rating').value = rating;
                                }
                            }

                            stars.forEach((star, index) => {
                                // Hover effects
                                star.addEventListener('mouseenter', () => {
                                    if (selectedRating === 0) {
                                        updateStars(index + 1);
                                    }
                                });

                                star.addEventListener('mouseleave', () => {
                                    if (selectedRating === 0) {
                                        updateStars(0);
                                    } else {
                                        updateStars(selectedRating, true);
                                    }
                                });

                                // Click handler
                                star.addEventListener('click', () => {
                                    updateStars(index + 1, true);
                                });
                            });
                        });
                    </script>

                    <!-- Reviews List -->
                    <div class="space-y-6">
                        @forelse ($property->reviews()->with('user')->latest()->get() as $review)
                            <div class="bg-white rounded-lg shadow p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="flex items-center mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                                                     fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                        <p class="text-gray-600">{{ $review->comment }}</p>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <p>{{ $review->user->name }}</p>
                                        <p>{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">No reviews yet. Be the first to review this property!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 