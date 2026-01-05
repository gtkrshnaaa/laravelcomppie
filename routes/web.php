<?php

use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;

// Public Homepage (temporary)
Route::get('/', function () {
    return view('welcome');
});

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Login routes
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
});
