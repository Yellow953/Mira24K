<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\JeweleryModelController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Auth
Route::middleware(['auth'])->group(function () {
    // App
    Route::prefix('app')->group(function () {
        // Profile
        Route::prefix('profile')->group(function () {
            Route::post('/save_password', [ProfileController::class, 'save_password'])->name('profile.save_password');
            Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
            Route::get('/', [ProfileController::class, 'show'])->name('profile');
        });

        // Settings
        Route::prefix('settings')->group(function () {
            Route::post('/update', [SettingsController::class, 'update'])->name('settings.update');
            Route::get('/', [SettingsController::class, 'show'])->name('settings');
        });

        // Users
        Route::prefix('users')->group(function () {
            Route::get('/export', [UserController::class, 'export'])->name('users.export');
            Route::get('/new', [UserController::class, 'new'])->name('users.new');
            Route::post('/create', [UserController::class, 'create'])->name('users.create');
            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
            Route::post('/update/{user}', [UserController::class, 'update'])->name('users.update');
            Route::get('/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
            Route::get('/', [UserController::class, 'index'])->name('users');
        });

        // Parts
        Route::prefix('parts')->group(function () {
            Route::get('/export', [PartController::class, 'export'])->name('parts.export');
            Route::get('/new', [PartController::class, 'new'])->name('parts.new');
            Route::post('/create', [PartController::class, 'create'])->name('parts.create');
            Route::get('/edit/{part}', [PartController::class, 'edit'])->name('parts.edit');
            Route::post('/update/{part}', [PartController::class, 'update'])->name('parts.update');
            Route::get('/delete/{part}', [PartController::class, 'destroy'])->name('parts.destroy');
            Route::get('/', [PartController::class, 'index'])->name('parts');
        });

        // Jewelery Models
        Route::prefix('jewelery_models')->group(function () {
            Route::get('/export', [JeweleryModelController::class, 'export'])->name('jewelery_models.export');
            Route::get('/new', [JeweleryModelController::class, 'new'])->name('jewelery_models.new');
            Route::post('/create', [JeweleryModelController::class, 'create'])->name('jewelery_models.create');
            Route::get('/edit/{jewelery_model}', [JeweleryModelController::class, 'edit'])->name('jewelery_models.edit');
            Route::post('/update/{jewelery_model}', [JeweleryModelController::class, 'update'])->name('jewelery_models.update');
            Route::get('/delete/{jewelery_model}', [JeweleryModelController::class, 'destroy'])->name('jewelery_models.destroy');
            Route::get('/', [JeweleryModelController::class, 'index'])->name('jewelery_models');
        });

        // Products
        Route::prefix('products')->group(function () {
            Route::get('/export', [ProductController::class, 'export'])->name('products.export');
            Route::get('/new', [ProductController::class, 'new'])->name('products.new');
            Route::post('/create', [ProductController::class, 'create'])->name('products.create');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
            Route::post('/update/{product}', [ProductController::class, 'update'])->name('products.update');
            Route::get('/delete/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
            Route::get('/', [ProductController::class, 'index'])->name('products');
        });

        // Resellers
        Route::prefix('resellers')->group(function () {
            Route::get('/export', [ResellerController::class, 'export'])->name('resellers.export');
            Route::get('/new', [ResellerController::class, 'new'])->name('resellers.new');
            Route::post('/create', [ResellerController::class, 'create'])->name('resellers.create');
            Route::get('/edit/{reseller}', [ResellerController::class, 'edit'])->name('resellers.edit');
            Route::post('/update/{reseller}', [ResellerController::class, 'update'])->name('resellers.update');
            Route::get('/delete/{reseller}', [ResellerController::class, 'destroy'])->name('resellers.destroy');
            Route::get('/', [ResellerController::class, 'index'])->name('resellers');
        });

        // Logs
        Route::prefix('logs')->group(function () {
            Route::get('/export', [LogController::class, 'export'])->name('logs.export');
            Route::get('/', [LogController::class, 'index'])->name('logs');
        });

        // App
        Route::get('/', [AppController::class, 'index'])->name('app');
    });

    // Logout
    Route::get('/custom_logout', [AppController::class, 'custom_logout'])->name('custom_logout');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
