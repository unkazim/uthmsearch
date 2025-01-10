<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run()
    {
        Property::create([
            'title' => 'Single Storey 5 Bilik',
            'description' => 'Spacious single storey house near UTHM',
            'location' => '83000, Batu Pahat, Johor',
            'area' => 'Parit Raja',
            'price' => 1200,
            'bedrooms' => 5,
            'bathrooms' => 3,
            'image' => 'properties/house1.jpg',
            'status' => 'available',
            'property_type' => 'house',
            'furnished' => 'partially',
            'size' => '1500 sqft',
            'contact_name' => 'John Doe',
            'contact_phone' => '0123456789',
            'contact_email' => 'john@example.com',
            'address' => 'Taman Mutiara Jalan Batu',
            'postcode' => '83000',
            'state' => 'Johor',
            'features' => ['parking', 'air-conditioning', 'wifi'],
            'is_active' => true,
        ]);

        // Add more properties as needed
    }
} 