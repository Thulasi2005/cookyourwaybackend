<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    // Register a new customer with optional profile picture upload
    public function register(Request $request)
{
    // Validate the input data, including profile picture
    $validator = Validator::make($request->all(), [
        'full_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:customers',
        'phone' => 'required|string|max:15',
        'password' => 'required|string|min:8|confirmed',
        'address' => 'required|string',
        'cuisine' => 'nullable|string',
        'allergies' => 'nullable|array',
        'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    // Return validation errors if any
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Handle profile picture upload
    $profilePicturePath = null;
    if ($request->hasFile('profile_picture')) {
        $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    // Create new customer
    $customer = Customer::create([
        'full_name' => $request->full_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'address' => $request->address,
        'cuisine' => $request->cuisine,
        'allergies' => $request->allergies,
        'profile_picture' => $profilePicturePath,
    ]);

    // Log customer creation
    \Log::info('Customer created:', $customer->toArray());

    return response()->json(['message' => 'Customer registered successfully'], 200);
}
}