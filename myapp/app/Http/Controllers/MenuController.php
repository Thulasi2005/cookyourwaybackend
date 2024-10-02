<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Fetch menu items based on identifier
    public function index($identifier)
    {
        $menuItems = Menu::where('identifier', $identifier)->get();
        return response()->json($menuItems);
    }

    // Store a new menu item
    public function store(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $menuItem = Menu::create($request->all());
        return response()->json($menuItem, 201);
    }

    // Update a menu item
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $menuItem = Menu::findOrFail($id);
        $menuItem->update($request->all());
        return response()->json($menuItem);
    }

    // Delete a menu item
    public function destroy($id)
    {
        $menuItem = Menu::findOrFail($id);
        $menuItem->delete();
        return response()->json(null, 204);
    }
}
