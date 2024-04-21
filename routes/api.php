<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    // Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/products/category/{category_name}', [ProductController::class, 'getProductsByCategory']);

    // Categories
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);

    // Sliders
    Route::get('/sliders', [SliderController::class, 'index']);
    Route::get('/sliders/{id}', [SliderController::class, 'show']);

    // Customer registration
    Route::post('/register', [CustomerController::class, 'register']);
    Route::post('/login', [CustomerController::class, 'login']);
    // Route::get('/carts/{customer_id}', [CartController::class, 'index']);
    // Route::get('/orders/{customer_id}', [OrderController::class, 'getOrder']);
    Route::get('/orders/customer/{customer_id}', [OrderController::class, 'getOrdersByCustomer']);


    Route::middleware('auth:sanctum')->prefix('carts')->group(function () {
        Route::post('/', [CartController::class, 'addToCart']);
        Route::put('/{id}', [CartController::class, 'updateCart']);
        Route::delete('/{id}', [CartController::class, 'removeFromCart']);

        Route::get('/carts/{customer_id}', [CartController::class, 'index']);

        Route::post('/orders', [OrderController::class, 'placeOrder']);


    });
});
