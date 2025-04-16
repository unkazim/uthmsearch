<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $sortBy = $request->input('sort_by', 'price');
        $sortOrder = $request->input('sort_order', 'desc');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $bedrooms = $request->input('bedrooms');
        $propertyType = $request->input('property_type');
        $furnished = $request->input('furnished');

        $properties = Property::query()
            ->where('is_active', true)
            ->when($query, function ($q) use ($query) {
                return $q->where(function ($q) use ($query) {
                    $q->where('location', 'like', "%{$query}%")
                      ->orWhere('area', 'like', "%{$query}%")
                      ->orWhere('title', 'like', "%{$query}%");
                });
            })
            ->when($minPrice, function ($q) use ($minPrice) {
                return $q->where('price', '>=', $minPrice);
            })
            ->when($maxPrice, function ($q) use ($maxPrice) {
                return $q->where('price', '<=', $maxPrice);
            })
            ->when($bedrooms, function ($q) use ($bedrooms) {
                return $q->where('bedrooms', $bedrooms);
            })
            ->when($propertyType, function ($q) use ($propertyType) {
                return $q->where('property_type', $propertyType);
            })
            ->when($furnished, function ($q) use ($furnished) {
                return $q->where('furnished', $furnished);
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(12);

        return view('properties.search', [
            'properties' => $properties,
            'query' => $query,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'bedrooms' => $bedrooms,
            'propertyType' => $propertyType,
            'furnished' => $furnished
        ]);
    }

    public function show(Property $property)
    {
        // Store the previous URL if it's from the search page
        if (url()->previous() !== url()->current()) {
            session(['search_results_url' => url()->previous()]);
        }

        return view('properties.show', compact('property'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
        ]);

        // Rest of your store logic
    }
} 