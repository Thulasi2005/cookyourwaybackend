<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCustomization extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_name',
        'quantity',
        'portion_size',
        'food_description',
        'price_range',
        'address',
        'delivery_method',
        'identifier',
    ];
}

