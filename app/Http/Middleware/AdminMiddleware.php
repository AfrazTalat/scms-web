<?php

namespace App\Http\Middleware;

use App\Enums\Users\UserBaseRoles;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::auth();
        if (!$user->hasRole(UserBaseRoles::ADMINISTRATOR) && !$user->can('access_admin_panel')) {
            return res()->unauthorized();
        }

        return $next($request);
    }
}
