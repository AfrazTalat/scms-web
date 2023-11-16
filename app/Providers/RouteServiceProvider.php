<?php

namespace App\Providers;

use App\Http\Middleware\LocalizeClientSession;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::macro('crudResource', function ($uri, $controller, $allowedMethods = ['index', 'show', 'store', 'update', 'destroy'], $resource_id = 'id', $permissions = []) {
                Route::prefix($uri)->group(function () use ($uri, $controller, $allowedMethods, $resource_id, $permissions) {
                    if (in_array('index', $allowedMethods)) {
                        $indexRoute = Route::get("/", [$controller, 'index']);
                        if (isset($permissions['index'])) {
                            $indexRoute->middleware(['permission:' . $permissions['index']]);
                        }
                    }
                    if (in_array('show', $allowedMethods)) {
                        $showRoute = Route::get("/{{$resource_id}}", [$controller, 'show']);
                        if (isset($permissions['index'])) {
                            $showRoute->middleware('permission:' . $permissions['show']);
                        }
                    }
                    if (in_array('store', $allowedMethods)) {
                        $storeRoute = Route::post("/", [$controller, 'store']);
                        if (isset($permissions['index'])) {
                            $storeRoute->middleware('permission:' . $permissions['store']);
                        }
                    }
                    if (in_array('update', $allowedMethods)) {
                        $updateRoute = Route::post("/{{$resource_id}}", [$controller, 'update']);
                        if (isset($permissions['index'])) {
                            $updateRoute->middleware('permission:' . $permissions['update']);
                        }
                    }
                    if (in_array('destroy', $allowedMethods)) {
                        $destroyRoute = Route::delete("/{{$resource_id}}", [$controller, 'destroy']);
                        if (isset($permissions['index'])) {
                            $destroyRoute->middleware('permission:' . $permissions['destroy']);
                        }
                    }
                });
            });
            Route::middleware(LocalizeClientSession::class)->group(function () {
                Route::prefix('v1')
                    ->middleware('api')
                //->namespace("{$this->namespace}\\Api")
                    ->group(base_path('routes/groups/api/api.php'));

                Route::prefix('v1/admin')
                    ->middleware(['auth:api', 'admin'])
                //->namespace("{$this->namespace}\\Api\\Admin")
                    ->group(base_path('routes/groups/admin/admin.php'));

                Route::middleware('web')
                //->namespace($this->namespace)
                    ->group(base_path('routes/groups/web/web.php'));
            });
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(200)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
