<?php

use App\Http\Controllers\Api\Assets\LocaleFileController;
use Illuminate\Support\Facades\Route;

Route::get('locales/{locale_code}', LocaleFileController::class);
