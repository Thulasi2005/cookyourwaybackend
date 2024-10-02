<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FoodMakerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;

Route::post('/login-customer', [AuthController::class, 'loginCustomer']);

Route::post('/register-foodmaker', [FoodMakerController::class, 'register']);



Route::post('/register-customer', [CustomerController::class, 'register']);

Route::post('/login-food-maker', [FoodMakerController::class, 'login']);


Route::get('/menu/{identifier}', [MenuController::class, 'index']);
Route::post('/menu', [MenuController::class, 'store']);
Route::put('/menu/{id}', [MenuController::class, 'update']);
Route::delete('/menu/{id}', [MenuController::class, 'destroy']);

use App\Http\Controllers\CustomerMenuController;
use App\Http\Controllers\CartController;

// Menu routes
Route::get('/menu', [CustomerMenuController::class, 'browseMenu']);
Route::get('/menu/item/{id}', [CustomerMenuController::class, 'getItemDetails']);

// Cart routes
Route::post('/cart/add', [CartController::class, 'addToCart']);
Route::get('/cart', [CartController::class, 'getCartItems']);
Route::post('/cart/update', [CartController::class, 'updateCartItem']);
Route::post('/cart/remove', [CartController::class, 'removeFromCart']);

use App\Http\Controllers\FoodCustomizationController;

Route::post('/food-customizations', [FoodCustomizationController::class, 'store']);
Route::get('/response/food_customizations', [FoodCustomizationController::class, 'index']);

Route::put('/food_customizations/{id}/accept', [FoodCustomizationController::class, 'acceptRequest']);
Route::put('/food_customizations/{id}/decline', [FoodCustomizationController::class, 'declineRequest']);

use App\Http\Controllers\PaymentController;

Route::post('/payments', [PaymentController::class, 'store']);
Route::get('/paymentss', [PaymentController::class, 'index']);

use App\Http\Controllers\FoodMakerProfileController;

// Define a route for fetching food maker profiles
Route::get('/get_food_maker_profile', [FoodMakerProfileController::class, 'show']);

// Define a route for logging out food makers
Route::post('/logout_food_maker', [FoodMakerProfileController::class, 'logout']);

use App\Http\Controllers\CustomerProfileController;


// Define a route for fetching customer profiles
Route::post('/get_customer_profile', [CustomerProfileController::class, 'show']);









