<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer; // Import the Customer model

use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function loginCustomer(Request $request)
{
    $request->validate([
        'usernameOrEmail' => 'required|string',
        'password' => 'required|string',
    ]);

    // Try login with email
    $credentials = [
        'email' => $request->usernameOrEmail,
        'password' => $request->password,
    ];

    if (Auth::attempt($credentials)) {
        $customer = Auth::user();
        $token = $customer->createToken('CustomerToken')->plainTextToken;

        // Store the token in the database
        $customer->token = $token;
        $customer->save();

        return response()->json([
            'success' => true,
            'identifier' => $customer->email,
            'token' => $token // Return the token
        ]);
    }

    // Try login with full name
    $customer = Customer::where('full_name', $request->usernameOrEmail)->first();
    if ($customer && Hash::check($request->password, $customer->password)) {
        Auth::login($customer);
        $token = $customer->createToken('CustomerToken')->plainTextToken;

        // Store the token in the database
        $customer->token = $token;
        $customer->save();

        return response()->json([
            'success' => true,
            'identifier' => $customer->full_name,
            'token' => $token // Return the token
        ]);
    }

    return response()->json(['success' => false, 'message' => 'Invalid credentials.'], 401);
}
}