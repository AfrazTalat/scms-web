<?php

use App\Http\Controllers\Api\Auth\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/session', [SessionController::class, 'index']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user', function (Request $request) {
        $user = $request->user();
        if ($user) {
            $user->load(['roles', 'roles.permissions']);
        }
        return $user;
    });
});
