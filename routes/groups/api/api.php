<?php

use App\Http\Controllers\Admin\Content\DownloadAttachmentController;
use App\Http\Controllers\Api\Content\ArticleController;
use App\Http\Controllers\Api\Content\PageController;
use App\Http\Controllers\Api\Content\ProjectController;
use App\Http\Controllers\Api\Content\SliderController;
use App\Http\Controllers\Api\Extra\BranchController;
use App\Http\Controllers\Api\Extra\PartnerController;
use Illuminate\Support\Facades\Route;

Route::prefix('assets')->group(__DIR__ . '/assets.php');

Route::prefix('commons')->group(__DIR__ . '/commons.php');

Route::prefix('auth')->group(__DIR__ . '/auth.php');

Route::prefix('ecommerce')->group(__DIR__ . '/ecommerce.php');

Route::prefix('extras')->group(function () {
    Route::crudResource('partners', PartnerController::class);
    Route::crudResource('branches', BranchController::class);
});

Route::prefix('content')->group(function () {
    Route::crudResource('articles', ArticleController::class);
    Route::crudResource('pages', PageController::class, ['show'], resource_id:'slug');
    Route::crudResource('projects', ProjectController::class, ['index', 'show']);
    Route::crudResource('downloads', DownloadAttachmentController::class, ['index']);
    Route::crudResource('sliders', SliderController::class, ['index']);
});

// Route::get('ping', 'PingController@index');

// Route::get('assets/{uuid}/render', 'Assets\RenderFileController@show');

// Route::post('register', 'Auth\RegisterController@store');
// Route::post('passwords/reset', 'Auth\PasswordsController@store');
// Route::put('passwords/reset', 'Auth\PasswordsController@update');

// Route::group(['middleware' => ['auth:api']], function () {

//     Route::group(['prefix' => 'users'], function () {
//         Route::get('/', 'Users\UsersController@index');
//         Route::post('/', 'Users\UsersController@store');
//         Route::get('/{uuid}', 'Users\UsersController@show');
//         Route::put('/{uuid}', 'Users\UsersController@update');
//         Route::patch('/{uuid}', 'Users\UsersController@update');
//         Route::delete('/{uuid}', 'Users\UsersController@destroy');
//     });

//     Route::group(['prefix' => 'roles'], function () {
//         Route::get('/', 'Users\RolesController@index');
//         Route::post('/', 'Users\RolesController@store');
//         Route::get('/{uuid}', 'Users\RolesController@show');
//         Route::put('/{uuid}', 'Users\RolesController@update');
//         Route::patch('/{uuid}', 'Users\RolesController@update');
//         Route::delete('/{uuid}', 'Users\RolesController@destroy');
//     });

//     Route::get('permissions', 'Users\PermissionsController@index');

//     Route::group(['prefix' => 'me'], function () {
//         Route::get('/', 'Users\ProfileController@index');
//         Route::put('/', 'Users\ProfileController@update');
//         Route::patch('/', 'Users\ProfileController@update');
//         Route::put('/password', 'Users\ProfileController@updatePassword');
//     });

//     Route::group(['prefix' => 'assets'], function () {
//         Route::post('/', 'Assets\UploadFileController@store');
//     });
// });
