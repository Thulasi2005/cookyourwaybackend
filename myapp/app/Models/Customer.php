<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable; // This is necessary for authentication
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable // Extend Authenticatable instead of Model
{
    use HasApiTokens, Notifiable;

    protected $table = 'customers'; // Specify your custom table name if different

    protected $fillable = [
        'full_name', 'email', 'phone', 'password', 'address', 'cuisine', 'allergies', 'profile_picture',
    ];

    protected $casts = [
        'allergies' => 'array',
    ];

    protected $hidden = [
        'password',
    ];

    // Add any other necessary functionality
}
