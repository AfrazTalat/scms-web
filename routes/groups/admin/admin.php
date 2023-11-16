<?php

use App\Http\Controllers\Admin\Common\BrandController;
use App\Http\Controllers\Admin\Common\CategoryController;
use App\Http\Controllers\Admin\Common\SettingController;
use App\Http\Controllers\Admin\Content\ArticleController;
use App\Http\Controllers\Admin\Content\DownloadAttachmentController;
use App\Http\Controllers\Admin\Content\PageController;
use App\Http\Controllers\Admin\Content\ProjectController;
use App\Http\Controllers\Admin\Content\SliderController;
use App\Http\Controllers\Admin\Ecommerce\OrderController;
use App\Http\Controllers\Admin\Ecommerce\ProductController;
use App\Http\Controllers\Admin\Extra\BranchController;
use App\Http\Controllers\Admin\Extra\PartnerController;
use App\Http\Controllers\Admin\Users\PermissionController;
use App\Http\Controllers\Admin\Users\RolesController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\UserController;

Route::prefix('assets')->group(__DIR__ . '/assets.php');

Route::crudResource('users', UserController::class, permissions: [
    'index'   => 'users_list',
    'show'    => 'users_list',
    'store'   => 'users_create',
    'update'  => 'users_update',
    'destroy' => 'users_delete',
]);
Route::crudResource('roles', RolesController::class, permissions: [
    'index'   => 'roles_list',
    'show'    => 'roles_list',
    'store'   => 'roles_create',
    'update'  => 'roles_update',
    'destroy' => 'roles_delete',
]);
Route::crudResource('permissions', PermissionController::class, permissions: [
    'index'   => 'permissions_list',
    'show'    => 'permissions_list',
    'store'   => 'permissions_create',
    'update'  => 'permissions_update',
    'destroy' => 'permissions_delete',
]);

Route::prefix('commons')->group(function () {
    Route::crudResource('settings', SettingController::class, permissions: [
        'index'   => 'access_settings',
        'show'    => 'access_settings',
        'store'   => 'access_settings',
        'update'  => 'access_settings',
        'destroy' => 'access_settings',
    ]);
    Route::crudResource('categories', CategoryController::class, permissions: [
        'index'   => 'categories_list',
        'show'    => 'categories_list',
        'store'   => 'categories_create',
        'update'  => 'categories_update',
        'destroy' => 'categories_delete',
    ]);
    Route::crudResource('brands', BrandController::class, permissions: [
        'index'   => 'brands_list',
        'show'    => 'brands_list',
        'store'   => 'brands_create',
        'update'  => 'brands_update',
        'destroy' => 'brands_delete',
    ]);
});

Route::prefix('extras')->group(function () {
    Route::crudResource('partners', PartnerController::class, permissions: [
        'index'   => 'partners_list',
        'show'    => 'partners_list',
        'store'   => 'partners_create',
        'update'  => 'partners_update',
        'destroy' => 'partners_delete',
    ]);
    Route::crudResource('branches', BranchController::class, permissions: [
        'index'   => 'branches_list',
        'show'    => 'branches_list',
        'store'   => 'branches_create',
        'update'  => 'branches_update',
        'destroy' => 'branches_delete',
    ]);
});

Route::prefix('ecommerce')->group(function () {

    Route::post('products/import', [ProductController::class, 'importFromFile']);
    Route::crudResource('products', ProductController::class, permissions: [
        'index'   => 'products_list',
        'show'    => 'products_list',
        'store'   => 'products_create',
        'update'  => 'products_update',
        'destroy' => 'products_delete',
    ]);
    Route::crudResource('orders', OrderController::class, permissions: [
        'index'   => 'orders_list',
        'show'    => 'orders_list',
        'store'   => 'orders_create',
        'update'  => 'orders_update',
        'destroy' => 'orders_delete',
    ]);
    Route::post("orders/{id}/status", [OrderController::class, 'updateStatus'])
        ->middleware('permission:orders_update');
});

Route::prefix('content')->group(function () {
    Route::crudResource('articles', ArticleController::class, permissions: [
        'index'   => 'articles_list',
        'show'    => 'articles_list',
        'store'   => 'articles_create',
        'update'  => 'articles_update',
        'destroy' => 'articles_delete',
    ]);

    Route::crudResource('pages', PageController::class, permissions: [
        'index'   => 'pages_list',
        'show'    => 'pages_list',
        'store'   => 'pages_create',
        'update'  => 'pages_update',
        'destroy' => 'pages_delete',
    ]);

    Route::crudResource('projects', ProjectController::class, permissions: [
        'index'   => 'projects_list',
        'show'    => 'projects_list',
        'store'   => 'projects_create',
        'update'  => 'projects_update',
        'destroy' => 'projects_delete',
    ]);

    Route::crudResource('download-attachments', DownloadAttachmentController::class, permissions: [
        'index'   => 'download_attachments_list',
        'show'    => 'download_attachments_list',
        'store'   => 'download_attachments_create',
        'update'  => 'download_attachments_update',
        'destroy' => 'download_attachments_delete',
    ]);

    Route::crudResource('sliders', SliderController::class, permissions: [
        'index'   => 'sliders_list',
        'show'    => 'sliders_list',
        'store'   => 'sliders_create',
        'update'  => 'sliders_update',
        'destroy' => 'sliders_delete',
    ]);
});
