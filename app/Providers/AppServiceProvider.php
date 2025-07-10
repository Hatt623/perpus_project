<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
Use Auth;
use App\Models\Cart;
use App\Models\Lending;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.   
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
    {
        View::composer('*', function ($view) {
            $cartItems = [];
            $lendingItems = [];

            if (Auth::check()) {
                $cartItems = Cart::with('book')->where('user_id', Auth::id())->get();
                $lendingItems = Lending::with('book')->where('user_id', Auth::id())->get();
            }

            $view->with('cartItems', collect($cartItems))->with('lendingItems', collect($lendingItems));
        });
    }
}
