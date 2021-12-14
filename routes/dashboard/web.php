<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/', [DashboardController::class, 'home'])->name('home');

            Route::resource('users', UserController::class);

            Route::resource('categories', CategoryController::class);

            Route::resource('products', ProductController::class);

            Route::resource('clients', ClientController::class);

            Route::resource('clients.orders', 'Client\OrderController');

            Route::resource('orders', 'OrderController');

            Route::get('/orders/{order}/products', [OrderController::class, 'products'])->name('orders.products');

        });

    });

