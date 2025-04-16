<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'property_id', 'rating', 'comment'];

    protected $casts = [
        'rating' => 'integer'
    ];

    // Add rating validation rule
    public static $rules = [
        'rating' => 'required|integer|min:1|max:5'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}