<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodMaker;
use App\Models\FoodCustomization; // Ensure you import the FoodCustomization model
use App\Models\Payment; // Ensure you import the Payment model

class FoodMakerProfileController extends Controller
{
    public function show(Request $request)
    {
        // Get the food maker's identifier from the request
        $identifier = $request->input('identifier');

        // Fetch food maker details from the database using the provided identifier
        $foodMaker = FoodMaker::where('full_name', $identifier)->first(); // Update 'full_name' with 'identifier'

        // If food maker is found, calculate metrics
        if ($foodMaker) {
            // Calculate the total number of orders received (no filter)
            $ordersReceivedCount = FoodCustomization::count();

            // Calculate the number of orders prepared (using the chef_identifier)
            $ordersPreparedCount = FoodCustomization::where('chef_identifier', $foodMaker->full_name)->count();

            // Calculate the total number of payments received (without filtering)
            $paymentsReceivedCount = Payment::count();

            // Calculate total revenue earned (without filtering)
            $revenueEarned = Payment::sum('amount');

            return response()->json([
                'id' => $foodMaker->id,
                'full_name' => $foodMaker->full_name,
                'email' => $foodMaker->email,
                'phone' => $foodMaker->phone,
                'address' => $foodMaker->address,
                'profile_picture' => $foodMaker->profile_picture,
                'orders_received' => $ordersReceivedCount,
                'orders_prepared' => $ordersPreparedCount,
                'payments_received' => $paymentsReceivedCount,
                'revenue_earned' => $revenueEarned,
                'created_at' => $foodMaker->created_at,
                'updated_at' => $foodMaker->updated_at,
            ]);
        }

        // If food maker not found, return a 404 response
        return response()->json(['message' => 'Food maker not found'], 404);
    }

    // Function to handle food maker logout
    public function logout(Request $request)
    {
        // Assuming you will clear the session, token, or perform necessary actions
        return response()->json(['message' => 'Successfully logged out']);
    }
}
