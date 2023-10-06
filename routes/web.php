<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('businesses', BusinessController::class);
    Route::resource('users', UserController::class); // Admin routes for users
});



// Business Routes
Route::middleware(['auth'])->prefix('business')->group(function () {
    Route::get('/dashboard', [BusinessController::class, 'dashboard'])->name('business.dashboard');
    Route::resource('promotions', PromotionController::class);
    Route::delete('/promotions/delete/{id}', [PromotionController::class, 'destroy'])->name('promotion.destroy');
});