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
            ->orderBy($sortBy, $sortOrder)
            ->paginate(12);

        return view('properties.search', [
            'properties' => $properties,
            'query' => $query,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'bedrooms' => $bedrooms
        ]);
    }

    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }
} 