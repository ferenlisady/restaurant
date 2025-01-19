<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

Auth::routes();

// Customer-specific routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'showProfile'])->name('profile.view'); // View profile
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Update profile
    Route::post('/order/add/{menuId}', [OrderController::class, 'addToOrder'])->name('order.add'); // Add to order
    Route::get('/order', [OrderController::class, 'orderPage'])->name('order.index'); // Order page
    Route::put('/order/{orderId}/update-quantity', [OrderController::class, 'updateQuantity'])->name('order.updateQuantity'); // Update order quantity
    Route::delete('/order/{orderId}', [OrderController::class, 'delete'])->name('order.delete'); // Delete order
    Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout'); // Checkout order
});

// Restaurant owner-specific routes
Route::middleware(['auth', 'role:resto'])->group(function () {
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create'); // Create menu
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store'); // Store menu
});

// Admin-specific routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/restaurant/create', [RestaurantController::class, 'create'])->name('restaurant.create');
    Route::post('/restaurant', [RestaurantController::class, 'store'])->name('restaurant.store');
    Route::delete('/restaurant/{id}', [RestaurantController::class, 'destroy'])->name('restaurant.destroy');
});

// Common routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('home'); // Home page
    Route::get('/menu', [MenuController::class, 'menuPage'])->name('menu.index'); // Menu page
    Route::get('/about', function () {
        return view('about');
    })->name('aboutus'); // About us page
    Route::get('/restaurant', [RestaurantController::class, 'restaurantPage'])->name('restaurant.index'); // Restaurant page
    Route::get('/restaurant/{id}', [RestaurantController::class, 'restaurantDetail'])->name('restaurant.detail'); // Restaurant detail page
    Route::get('/menu/{id}', [MenuController::class, 'menuDetail'])->name('menu.detail'); // Menu detail page

    // Localization route
    Route::get('/set-locale/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'id'])) {
            session(['locale' => $locale]);
        }
        return redirect()->back();
    })->name('set-locale');

    // Logout route
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});
