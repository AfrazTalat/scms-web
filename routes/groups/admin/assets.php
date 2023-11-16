<?php

use App\Http\Controllers\Admin\Assets\LocaleFileController;
use Illuminate\Support\Facades\Route;

Route::post('locales/{type}/{locale_code}', [LocaleFileController::class, 'store'])
    ->middleware(['permission:access_translations']);
