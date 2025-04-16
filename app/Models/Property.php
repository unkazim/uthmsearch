<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'status',
        'property_type',
        'furnished',
        'size',
        'contact_name',
        'contact_phone',
        'contact_email',
        'address',
        'postcode',
        'state',
        'features',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'features' => 'array'
    ];

    // Image handling
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : '/images/placeholder.jpg';
    }

    public function deleteImage()
    {
        if ($this->image && Storage::exists($this->image)) {
            Storage::delete($this->image);
        }
    }

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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
}