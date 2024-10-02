<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerProfileController extends Controller
{
    public function show(Request $request)
    {
        // Get identifier and token from request
        $identifier = $request->input('identifier');
        $token = $request->input('token');

        // Fetch customer details from the database using the identifier (full_name)
        $customer = Customer::where('full_name', $identifier)
            ->where('token', $token)
            ->first();

        // If customer is found, return the profile data
        if ($customer) {
            return response()->json([
                'id' => $customer->id,
                'full_name' => $customer->full_name,
                'email' => $customer->email,
                'phone' => $customer->phone,
                'address' => $customer->address,
                'cuisine' => $customer->cuisine,
                'allergies' => $customer->allergies,
                'profile_picture' => $customer->profile_picture,
                'token' => $customer->token,
                'created_at' => $customer->created_at,
                'updated_at' => $customer->updated_at,
            ]);
        }

        // If customer not found, return a 404 response
        return response()->json(['message' => 'Customer not found'], 404);
    }
}
