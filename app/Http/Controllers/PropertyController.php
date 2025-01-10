<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $sortBy = $request->input('sort', 'price_high');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $bedrooms = $request->input('bedrooms');

        $properties = Property::query()
            ->active() // Only show active listings
            ->when($query, function($query, $searchTerm) {
                return $query->search($searchTerm);
            })
            ->when($minPrice, function($query, $price) {
                return $query->where('price', '>=', $price);
            })
            ->when($maxPrice, function($query, $price) {
                return $query->where('price', '<=', $price);
            })
            ->when($bedrooms, function($query, $beds) {
                return $query->where('bedrooms', $beds);
            })
            ->when($sortBy, function($query, $sortBy) {
                return match($sortBy) {
                    'price_high' => $query->orderByDesc('price'),
                    'price_low' => $query->orderBy('price'),
                    'bedrooms' => $query->orderByDesc('bedrooms'),
                    default => $query
                };
            })
            ->get();

        return view('property.search-results', [
            'properties' => $properties,
            'searchQuery' => $query,
            'filters' => [
                'sort' => $sortBy,
                'min_price' => $minPrice,
                'max_price' => $maxPrice,
                'bedrooms' => $bedrooms
            ]
        ]);
    }

    public function show($id)
    {
        // Property details page logic here
        return view('property.show');
    }
} 