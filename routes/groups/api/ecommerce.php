<?php

use App\Http\Controllers\Api\Ecommerce\CartController;
use App\Http\Controllers\Api\Ecommerce\ProductController;
use Illuminate\Support\Facades\Route;

Route::crudResource('products', ProductController::class, ['index', 'show']);

// Route::middleware('auth:api')->group(function () {
Route::prefix('cart/{cart_id}')->group(function () {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/order', [CartController::class, 'transformToOrder']);
    Route::post('/{product_id}', [CartController::class, 'store']);
    Route::put('/{cart_item_id}', [CartController::class, 'update']);
    Route::delete('/{cart_item_id}', [CartController::class, 'destroy']);
});
// });
