<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location');
            $table->string('area');
            $table->decimal('price', 10, 2);
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->string('image')->nullable();
            $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
            $table->enum('property_type', ['house', 'apartment', 'room'])->default('house');
            $table->enum('furnished', ['yes', 'no', 'partially'])->default('no');
            $table->string('size')->nullable();
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->string('address');
            $table->string('postcode', 10);
            $table->string('state');
            $table->json('features')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Indexes for faster searching
            $table->index(['location', 'area', 'price', 'bedrooms']);
            $table->index('status');
            $table->index('is_active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};