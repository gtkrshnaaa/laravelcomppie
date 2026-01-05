<?php

use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;

// Public Homepage (temporary)
Route::get('/', function () {
    return view('welcome');
});

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Login routes (guest only)
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.post');
    
    // Protected admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
        
        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/company', [\App\Http\Controllers\Admin\Settings\CompanyController::class, 'index'])->name('company.index');
            Route::put('/company', [\App\Http\Controllers\Admin\Settings\CompanyController::class, 'update'])->name('company.update');
        });
    });
});
