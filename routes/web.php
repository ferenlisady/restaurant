<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('home'); // Home page
    Route::get('/menu', [MenuController::class, 'menuPage'])->name('menu.index'); // Menu page
    Route::post('/order/add/{menuId}', [OrderController::class, 'addToOrder'])->name('order.add');
    Route::get('/about', function () {
        return view('about');
    })->name('aboutus'); // About us page
    Route::get('/restaurant', [RestaurantController::class, 'restaurantPage'])->name('restaurant.index'); // Restaurant page
    Route::get('/restaurant/{id}', [RestaurantController::class, 'restaurantDetail'])->name('restaurant.detail'); // Restaurant detail
    Route::get('/order', [OrderController::class, 'orderPage'])->name('order.index'); // Order page
    Route::put('/order/{orderId}/update-quantity', [OrderController::class, 'updateQuantity'])->name('order.updateQuantity');
    Route::delete('/order/{orderId}', [OrderController::class, 'delete'])->name('order.delete');
    Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::get('/menu/{id}', [MenuController::class, 'menuDetail'])->name('menu.detail'); // Menu detail page
    Route::get('/profile/{id}', [ProfileController::class, 'showProfile'])->name('profile.view'); // Viewing
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Updating
    Route::post('/logout', function () {
        Auth::logout(); // Log the user out
        return redirect('/login'); // Redirect to the home page after logout
    })->name('logout'); // Logout route
});