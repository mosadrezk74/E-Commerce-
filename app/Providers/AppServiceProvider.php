<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\CartService;
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


        $categories=Category::all();
        view()->share('categories', $categories);
        View::composer('*', function ($view) {
            $cart = session()->get('cart', []);
            $cartCount = array_sum(array_column($cart, 'quantity'));

            $totalPrice = array_reduce($cart, function ($total, $item) {
                return $total + ($item['Price'] ?? 0) * ($item['quantity'] ?? 1);
            }, 0);


        $view->with(compact('cart', 'cartCount', 'totalPrice'));
        });

    }

}
