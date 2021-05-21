<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'ingredients',
        'instructions'
    ];

    //Tell laravel to fetch text values and set them as arrays
    protected $casts = [
        'image' => 'array',
        'ingredients' => 'array'
    ];
}
