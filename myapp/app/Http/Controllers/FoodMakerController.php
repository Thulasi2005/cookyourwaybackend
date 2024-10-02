<?php

namespace App\Http\Controllers;

use App\Models\FoodMaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class FoodMakerController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'business_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:food_makers',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8',
            'address' => 'required|string',
            'bio' => 'required|string',
            'cuisine_specialties' => 'nullable|json',
            'delivery_options' => 'required|string|in:Delivery,Takeaway',
            'profile_picture' => 'nullable|image|max:2048', // Image size limit 2MB
            'certification' => 'nullable|image|max:2048',
        ]);

        // Handle file uploads
        $profilePicturePath = $certificationPath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }
        if ($request->hasFile('certification')) {
            $certificationPath = $request->file('certification')->store('certifications', 'public');
        }

        // Create the food maker
        $foodMaker = FoodMaker::create([
            'full_name' => $validatedData['full_name'],
            'business_name' => $validatedData['business_name'] ?? null,
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => $validatedData['password'],
            'address' => $validatedData['address'],
            'bio' => $validatedData['bio'],
            'cuisine_specialties' => json_decode($validatedData['cuisine_specialties'], true),
            'delivery_options' => $validatedData['delivery_options'],
            'profile_picture' => $profilePicturePath,
            'certification' => $certificationPath,
        ]);

        return response()->json(['message' => 'Registration successful'], 200);
    }

    public function login(Request $request)
{
    $validatedData = $request->validate([
        'usernameOrEmail' => 'required|string',
        'password' => 'required|string',
    ]);

    // Attempt login
    $credentials = [
        'email' => $validatedData['usernameOrEmail'],
        'password' => $validatedData['password'],
    ];

    if (Auth::guard('food_maker')->attempt($credentials)) {
        $foodMaker = Auth::guard('food_maker')->user();
        $token = $foodMaker->createToken('FoodMakerToken')->plainTextToken;
        
        // Save the token to the database
        $foodMaker->token = $token;
        $foodMaker->save();

        return response()->json([
            'success' => true,
            'identifier' => $foodMaker->full_name,
            'token' => $token,
        ]);
    }

    // Try login with full name
    $foodMaker = FoodMaker::where('full_name', $validatedData['usernameOrEmail'])->first();
    if ($foodMaker && Hash::check($validatedData['password'], $foodMaker->password)) {
        Auth::guard('food_maker')->login($foodMaker);
        $token = $foodMaker->createToken('FoodMakerToken')->plainTextToken;

        // Save the token to the database
        $foodMaker->token = $token;
        $foodMaker->save();

        return response()->json([
            'success' => true,
            'identifier' => $foodMaker->full_name,
            'token' => $token,
        ]);
    }

    return response()->json(['success' => false, 'message' => 'Invalid credentials.'], 401);
}
}