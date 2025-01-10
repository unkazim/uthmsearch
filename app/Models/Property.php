<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'area',
        'price',
        'bedrooms',
        'bathrooms',
        'image',
        'status', // available, rented, maintenance
        'property_type', // house, apartment, room
        'furnished', // yes, no, partially
        'size',
        'contact_name',
        'contact_phone',
        'contact_email',
        'address',
        'postcode',
        'state',
        'features', // JSON field for additional features
        'is_active', // for admin to hide/show property
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];

    // Scope for active listings
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for search
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function($query) use ($searchTerm) {
            $query->where('location', 'like', "%{$searchTerm}%")
                  ->orWhere('area', 'like', "%{$searchTerm}%")
                  ->orWhere('title', 'like', "%{$searchTerm}%")
                  ->orWhere('address', 'like', "%{$searchTerm}%");
        });
    }
} 