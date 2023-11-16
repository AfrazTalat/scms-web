<?php

namespace App\Http\Controllers\Api\Assets;

use App\Http\Controllers\Controller;
use File;

class LocaleFileController extends Controller
{
    public function __invoke()
    {
        list($type, $locale) = explode("-", request()->route('locale_code'));
        if (!$type || !$locale) {
            return res()->unauthorized();
        }
        if (!File::exists(public_path("assets/i18n/locales/{$type}/{$locale}.json"))) {
            return "{}";
        }
        return File::get(public_path("assets/i18n/locales/{$type}/{$locale}.json"));
    }
}
