<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Front\CartController;

Route::group(
    [


    ],
    function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::get('/send', [FrontController::class, 'send'])->name('send');

        Route::get('/', [FrontController::class, 'index'])->name('front.index');
        Route::get('/shop', [FrontController::class, 'shop'])->name('front.shop');
        Route::get('/shop/product/{id}', [FrontController::class, 'show_product'])->name('front.product.show');
       //Product Detail
       Route::middleware(['auth'])->group(function () {
            Route::get('cart', [CartController::class, 'cart'])->name('cart');
            Route::get('wishlist', [CartController::class, 'wishlist'])->name('wishlist');
            Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add_to_cart');
            Route::get('add-to-wishlist/{id}', [CartController::class, 'addToWishlist'])->name('addToWishlist');
            Route::patch('update-cart', [CartController::class, 'update'])->name('update_cart');
            Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove_from_cart');

        }
       );

    Route::post('checkout', [FrontController::class, 'HandleCheckout'])->name('checkout.store');

    Route::get('profile', [FrontController::class, 'edit_profile'])->name('profile.edit');

    Route::put('profile/edit', [FrontController::class, 'update_profile'])->name('profile.update');


        Route::get('/search', [ProductController::class, 'search'])->name('search');

        Route::get('category/{id}', [FrontController::class, 'category_product']);

        Route::get('about', [FrontController::class, 'about'])
        ->name('about');

        Route::get('checkout', [FrontController::class, 'checkout'])
        ->name('checkout');

        Route::get('contact', [FrontController::class, 'contact'])
        ->name('contact');

        Route::post('/apply-coupon', [FrontController::class, 'applyCoupon'])->name('apply_coupon');


        Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
        Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');


        Route::middleware(['auth', 'admin_auth'])->group(function () {

            Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

            Route::prefix('admin/category')->name('admin.category.')->group(function () {
                Route::get('/', [CategoryController::class, 'index'])->name('index');
                Route::get('/create', [CategoryController::class, 'create'])->name('create');
                Route::post('/store', [CategoryController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
                Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
            });

            Route::get('admin/report', [ReportController::class, 'index'])->name('admin.report.index');

            Route::prefix('admin/coupon')->name('admin.coupon.')->group(function () {
                Route::get('/', [CouponController::class, 'index'])->name('index');
                Route::get('/create', [CouponController::class, 'create'])->name('create');
                Route::post('/store', [CouponController::class, 'store'])->name('store');
                Route::get('/delete/{id}', [CouponController::class, 'delete'])->name('delete');
                Route::get('/status/{status}/{id}', [CouponController::class, 'status'])->name('status');
            });



            Route::prefix('admin/product')->name('admin.product.')->group(function () {
                Route::get('/', [ProductController::class, 'index'])->name('index');
                Route::get('/create', [ProductController::class, 'create'])->name('create');
                Route::post('/store', [ProductController::class, 'store'])->name('store');
                Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
            });



            Route::prefix('admin/customer')->name('admin.customer.')->group(function () {
                Route::get('/', [CustomerController::class, 'index'])->name('index');
                Route::get('/show/{id}', [CustomerController::class, 'show'])->name('show');
                Route::get('/delete/{id}', [CustomerController::class, 'delete'])->name('delete');
                Route::get('/status/{status}/{id}', [CustomerController::class, 'status'])->name('status');
            });



            Route::prefix('admin/order')->name('admin.order.')->group(function () {
                Route::get('/', [OrderController::class, 'index'])->name('index');
                Route::get('/detail/{id}', [OrderController::class, 'order_detail'])->name('detail');
                Route::post('/detail/{id}', [OrderController::class, 'update_track_detail'])->name('update_track_detail');
                Route::get('/payment_status/{status}/{id}', [OrderController::class, 'update_payemnt_status'])->name('payment_status');
                Route::get('/order_status/{status}/{id}', [OrderController::class, 'update_order_status'])->name('order_status');
            });

            Route::get('admin/logout', function () {
                session()->forget('ADMIN_LOGIN');
                session()->forget('ADMIN_ID');
                return redirect('admin');
            })->name('admin.logout');
        });

        Route::get('/verification/{id}', [FrontController::class, 'email_verification'])->name('verification');
        Route::post('forgot_password', [FrontController::class, 'forgot_password'])->name('forgot_password');
        Route::get('/forgot_password_change/{id}', [FrontController::class, 'forgot_password_change'])->name('forgot_password_change');
        Route::post('forgot_password_change_process', [FrontController::class, 'forgot_password_change_process'])->name('forgot_password_change_process');
        Route::get('/checkout', [FrontController::class, 'checkout'])->name('checkout');

        Route::post('apply_coupon_code', [FrontController::class, 'apply_coupon_code'])->name('apply_coupon_code');
        Route::post('remove_coupon_code', [FrontController::class, 'remove_coupon_code'])->name('remove_coupon_code');

        Route::post('place_order', [FrontController::class, 'place_order'])->name('place_order');
        Route::get('/order_placed', [FrontController::class, 'order_placed'])->name('order_placed');

        Route::get('category', [FrontController::class, 'category'])->name('category');

        Route::get('/order_fail', [FrontController::class, 'order_fail'])->name('order_fail');
        Route::get('/instamojo_payment_redirect', [FrontController::class, 'instamojo_payment_redirect'])->name('instamojo_payment_redirect');

        Route::group(['middleware' => 'user_auth'], function () {

            Route::get('/order', [FrontController::class, 'order'])->name('order');
            Route::get('/order_detail/{id}', [FrontController::class, 'order_detail'])->name('order_detail');
        });
    }
);
require __DIR__.'/auth.php';
