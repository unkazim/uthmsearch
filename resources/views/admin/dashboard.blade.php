@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-4">Admin Dashboard</h2>
                
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-600">Total Properties</h3>
                        <p class="text-3xl font-bold text-primary-600">{{ $totalProperties }}</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-600">Available Properties</h3>
                        <p class="text-3xl font-bold text-green-600">{{ $availableProperties }}</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-600">Rented Properties</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $rentedProperties }}</p>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.properties.create') }}" 
                           class="btn-primary">
                            Add New Property
                        </a>
                        <a href="{{ route('admin.properties.index') }}" 
                           class="btn-secondary">
                            View All Properties
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 