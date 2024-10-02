<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\LoginController; // Adjust the namespace as necessary
use App\Http\Controllers\AdminController; // Controller for admin dashboard

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');

// Edit User
Route::get('/admin/users/edit/{id}', [AdminController::class, 'edit'])->name('admin.users.edit');

// Update User
Route::put('/admin/users/update/{id}', [AdminController::class, 'update'])->name('admin.users.update');

// Delete User
Route::delete('/admin/users/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');


// Admin routes
Route::get('/admin/food-makers', [AdminController::class, 'manageFoodMakers'])->name('admin.foodMakers');
Route::get('/admin/food-makers/edit/{id}', [AdminController::class, 'editFoodMaker'])->name('admin.foodMakers.edit');
Route::put('/admin/food-makers/update/{id}', [AdminController::class, 'updateFoodMaker'])->name('admin.foodMakers.update');
Route::delete('/admin/food-makers/destroy/{id}', [AdminController::class, 'destroyFoodMaker'])->name('admin.foodMakers.destroy');


