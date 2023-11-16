<?php

namespace App\Providers;

use App\Overrides\Ecommerce\CartDBStorage;
use Darryldecode\Cart\Cart;
use Illuminate\Support\ServiceProvider;

class ShoppingCartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('shopping_cart', function ($app) {
            $storage      = new CartDBStorage();
            $events       = $app['events'];
            $instanceName = 'cart_2';
            $session_key  = '88uuiioo99888';
            return new Cart(
                $storage,
                $events,
                $instanceName,
                $session_key,
                config('shopping_cart')
            );
        });
    }
}
