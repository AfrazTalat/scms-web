<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->load(['roles', 'roles.permissions']);
        }
        return [
            'settings' => Setting::all(),
            'user'     => $request->user(),
        ];
    }
}
