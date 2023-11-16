<?php

use App\Http\Controllers\Api\Common\BrandController;
use App\Http\Controllers\Api\Common\CategoryController;
use App\Http\Controllers\Api\Common\ContactController;
use App\Http\Controllers\Api\Common\SettingController;
use App\Http\Controllers\Api\Ecommerce\ProductController;
use Illuminate\Support\Facades\Route;

Route::crudResource('settings', SettingController::class, ['index', 'show']);

Route::crudResource('brands', BrandController::class, ['index', 'show']);

Route::crudResource('categories', CategoryController::class, ['index', 'show']);

Route::crudResource('products', ProductController::class, ['index', 'show']);

Route::post('contact', [ContactController::class, 'sendMessage']);
