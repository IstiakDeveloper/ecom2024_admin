<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\CustomerController;
use App\Livewire\CategoryManagerComponent;
use App\Livewire\ProductManagerComponent;
use App\Livewire\SliderManagerComponent;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/admin/products', ProductManagerComponent::class)->name('admin.products');
Route::get('/admin/categories', CategoryManagerComponent::class)->name('admin.categories');
Route::get('/admin/sliders', SliderManagerComponent::class)->name('sliders.index');

// Route::prefix('api/v1')->group(function () {
//     // Products
//     Route::get('/products', [ProductController::class, 'index']);
//     Route::get('/products/{id}', [ProductController::class, 'show']);
//     Route::get('/products/category/{category_name}', [ProductController::class, 'getProductsByCategory']);

//     // Categories
//     Route::get('/categories', [CategoryController::class, 'index']);
//     Route::get('/categories/{id}', [CategoryController::class, 'show']);

//     // Sliders
//     Route::get('/sliders', [SliderController::class, 'index']);
//     Route::get('/sliders/{id}', [SliderController::class, 'show']);

//     // Customer registration
//     Route::post('/register', [CustomerController::class, 'register']);
//     Route::post('/login', [CustomerController::class, 'login']);
// });

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
