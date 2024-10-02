<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class FoodMaker extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'food_makers';

    protected $fillable = [
        'full_name', 'business_name', 'email', 'phone', 'password', 'address',
        'bio', 'cuisine_specialties', 'delivery_options', 'profile_picture', 'certification',
    ];

    protected $casts = [
        'cuisine_specialties' => 'array', // Store cuisine_specialties as an array
    ];

    // Automatically hash the password before saving
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
