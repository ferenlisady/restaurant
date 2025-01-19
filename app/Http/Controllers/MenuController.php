<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::paginate(3); // Display 3 menus on the homepage
        return view('home', compact('menus'));
    }

    public function menuPage(Request $request)
    {
        $query = Menu::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('price', $request->sort);
        }

        $menus = $query->paginate(9); // Paginate menus
        return view('menu.index', compact('menus'));
    }

    public function menuDetail($id)
    {
        $menu = Menu::find($id);
        return view('menu.detail', compact('menu'));
    }

    // Show the form to add a new menu
    public function create()
    {
        $restaurants = Restaurant::all();
        return view('menu.create', compact('restaurants'));
    }

    // Store the new menu
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'restaurant_id' => 'required|exists:restaurants,id', // Make sure restaurant_id is valid
            'image' => 'nullable|string', // Optional image
        ]);

        // Retrieve the image URL from the request or set it to null
        $image = $request->image ? $request->image : null;

        // Create a new menu item and assign the necessary fields
        $menu = new Menu([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image' => $image, // Store image URL if provided
            'restaurant_id' => $request->input('restaurant_id'), // Pass the restaurant_id
        ]);

        // Save the menu item to the database
        $menu->save();

        // Redirect to the menu creation page with a success message
        return redirect()->route('menu.create')->with('success', 'Menu item added successfully.');
    }
}
