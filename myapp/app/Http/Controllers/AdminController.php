<?php
namespace App\Http\Controllers;

use App\Models\User; // User model
use App\Models\FoodMaker; // FoodMaker model
use App\Models\Customer; // Customer model
use App\Models\FoodCustomization; // FoodCustomization model
use App\Models\Payment; // Payment model
use App\Models\Menu; //
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show admin dashboard
    public function index()
    {
        $totalUsers = User::count(); // Count total users
        $totalFoodMakers = FoodMaker::count(); // Count food makers
        $totalCustomers = Customer::count(); // Count customers
        $totalCustomizedRequests = FoodCustomization::count(); // Count food customizations
        $totalCashPayments = Payment::where('payment_method', 'cash')->count(); // Count cash payments
        $totalCardPayments = Payment::where('payment_method', 'card')->count(); // Count card payments
        $totalMenus = Menu::count(); // Count total menu items

        $totalRevenue = Payment::sum('amount') * 0.05; // Assuming 'amount' is the column name for payment amounts

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalFoodMakers' => $totalFoodMakers,
            'totalCustomers' => $totalCustomers,
            'totalCustomizedRequests' => $totalCustomizedRequests,
            'totalCashPayments' => $totalCashPayments,
            'totalCardPayments' => $totalCardPayments,
            'totalMenus' => $totalMenus,
            'totalRevenue' => $totalRevenue,
        ]);
        
    }

    // Manage users
    public function manageUsers()
    {
        $customers = Customer::all(); // Get all customers
        $foodMakers = FoodMaker::all(); // Get all food makers

        return view('admin.users', compact('customers', 'foodMakers')); // Pass users to the view
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.edit_user', compact('customer'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            // Add other validation rules as needed
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    // Add methods for editing and deleting users as needed
    public function manageFoodMakers()
    {
        $foodMakers = FoodMaker::all(); // Get all food makers
        return view('admin.food_makers', compact('foodMakers')); // Pass food makers to the view
    }

    // Show edit food maker form
    public function editFoodMaker($id)
    {
        $foodMaker = FoodMaker::findOrFail($id);
        return view('admin.edit_food_maker', compact('foodMaker'));
    }

    // Update food maker
    public function updateFoodMaker(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            // Add other validation rules as needed
        ]);

        $foodMaker = FoodMaker::findOrFail($id);
        $foodMaker->update($request->all());

        return redirect()->route('admin.foodMakers')->with('success', 'Food maker updated successfully.');
    }

    // Delete food maker
    public function destroyFoodMaker($id)
    {
        $foodMaker = FoodMaker::findOrFail($id);
        $foodMaker->delete();

        return redirect()->route('admin.foodMakers')->with('success', 'Food maker deleted successfully.');
    }
}
