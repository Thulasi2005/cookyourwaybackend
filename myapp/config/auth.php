<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'), // Set to 'web' as default, but you can switch it dynamically
        'passwords' => 'users', // Default password broker for users
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | You may define every authentication guard for your application.
    | A great default configuration has been defined for you which
    | uses session storage and the Eloquent user provider.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Add a guard for customers
        'customer' => [
            'driver' => 'session',
            'provider' => 'customers',
        ],

        
        'food_maker' => [
        'driver' => 'session',
        'provider' => 'food_makers',
    ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication guards have a user provider. This defines how the
    | users are retrieved from your database or other storage mechanisms.
    | 
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class, // Your User model
        ],

        // Add a provider for customers
        'customers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Customer::class, // Your Customer model
        ],

        'food_makers' => [
        'driver' => 'eloquent',
        'model' => App\Models\FoodMaker::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Configuration for password reset behavior, including the storage table
    | and token expiry.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens', // Table for user password reset tokens
            'expire' => 60,
            'throttle' => 60,
        ],

        // Add password reset functionality for customers (if needed)
        'customers' => [
            'provider' => 'customers',
            'table' => 'customer_password_reset_tokens', // You may need a separate table
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | The amount of seconds before a password confirmation window expires.
    |
    */

    'password_timeout' => 10800,

];
