<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodCustomization;
use Illuminate\Support\Facades\Validator;

class FoodCustomizationController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'food_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'portion_size' => 'required|string|in:Small,Medium,Large',
            'food_description' => 'required|string',
            'price_range' => 'required|string',
            'address' => 'required|string',
            'delivery_method' => 'required|string|in:Pickup,Delivery',
            'identifier' => 'required|string', // New field for identifier
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Create a new food customization record
        $customization = FoodCustomization::create([
            'food_name' => $request->food_name,
            'quantity' => $request->quantity,
            'portion_size' => $request->portion_size,
            'food_description' => $request->food_description,
            'price_range' => $request->price_range,
            'address' => $request->address,
            'delivery_method' => $request->delivery_method,
            'identifier' => $request->identifier, // Save identifier
        ]);

        // Return a response indicating success
        return response()->json([
            'message' => 'Food customization created successfully!',
            'data' => $customization,
        ], 201);
    }

    public function index()
    {
        // Retrieve all requests from the food_customizations table
        $customizations = FoodCustomization::all();

        // Return the data as JSON
        return response()->json($customizations);
    }

    public function acceptRequest(Request $request, $id)
{
    $foodCustomization = FoodCustomization::findOrFail($id);
    $foodCustomization->status = 'Accepted';
    $foodCustomization->chef_identifier = $request->chef_identifier; // Get chef identifier from the request
    $foodCustomization->save();

    return response()->json(['message' => 'Request accepted successfully!'], 200);
}

public function declineRequest(Request $request, $id)
{
    $foodCustomization = FoodCustomization::findOrFail($id);
    $foodCustomization->status = 'Pending'; // Status will be changed back to Pending
    $foodCustomization->chef_identifier = null; // Clear the chef identifier
    $foodCustomization->save();

    return response()->json(['message' => 'Request declined successfully!'], 200);
}

}
