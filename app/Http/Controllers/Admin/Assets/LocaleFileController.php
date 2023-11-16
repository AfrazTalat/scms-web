<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;

class LocaleFileController extends Controller
{
    public function store(Request $request)
    {
        $type   = $request->route('type');
        $locale = $request->route('locale_code');
        $request->validate([
            'messages' => 'required|json',
        ]);

        File::put(public_path("assets/i18n/locales/{$type}/{$locale}.json"), $request->messages);
        return res()->success();
    }
}
