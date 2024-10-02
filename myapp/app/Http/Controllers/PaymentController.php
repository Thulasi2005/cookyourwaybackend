<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Models\Payment; // Import the Payment model

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'order_id' => 'required|string',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'card_holder_name' => 'required_if:payment_method,Card|string',
            'card_number' => 'required_if:payment_method,Card|string',
            'expiry_date' => 'required_if:payment_method,Card|string',
            'cvc' => 'required_if:payment_method,Card|string',
        ]);

        // Save payment details to the database
        $payment = new Payment();
        $payment->order_id = $validated['order_id'];
        $payment->amount = $validated['amount'];
        $payment->payment_method = $validated['payment_method'];
        $payment->card_holder_name = $validated['card_holder_name'];
        $payment->card_number = $validated['card_number'];
        $payment->expiry_date = $validated['expiry_date'];
        $payment->cvc = $validated['cvc'];
        $payment->save();

        return response()->json(['message' => 'Payment processed successfully'], 200);
    }

    // Method to fetch payments
    public function index(Request $request)
{
    // Fetch all payments from the payments table
    $payments = Payment::all(); // Retrieve all rows from the payments table

    // Return the payments as a JSON response
    return response()->json($payments);
}


}
