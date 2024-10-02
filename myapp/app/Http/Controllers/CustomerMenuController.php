<?php


namespace App\Http\Controllers;

use App\Models\Menu; // Use the Menu model
use Illuminate\Http\Request;

class CustomerMenuController extends Controller
{
    // Fetch menu items grouped by identifier
    public function browseMenu()
    {
        // Fetch all menu items and group them by 'identifier'
        $menuItems = Menu::all()->groupBy('identifier'); // Corrected to use Menu
        return response()->json($menuItems);
    }

    // Get details of a specific menu item by ID
    public function getItemDetails($id)
    {
        // Find the menu item by ID and return it
        $menuItem = Menu::findOrFail($id); // Corrected to use Menu
        return response()->json($menuItem);
    }
}

