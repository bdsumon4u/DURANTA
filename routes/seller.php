<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Seller Routes
|--------------------------------------------------------------------------
|
| Here is where you can register seller routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

notificationRoutes(['middleware' => ['web', 'auth:seller'], 'prefix' => 'seller', 'as' => 'seller.']);

Route::group(['prefix' => 'seller', 'as' => 'seller.'], function ($router) {
    Route::redirect('/', $router->getLastGroupPrefix() . RouteServiceProvider::HOME);

    Route::middleware('auth:seller')->group(function () {
        Route::get('/phone/verify', [\App\Http\Controllers\Auth\PhoneVerificationPromptController::class, '__invoke'])
            ->name('verification.notice');
        Route::middleware('throttle:6,1',)->group(function () {
            Route::get('/phone/verify/{id}/{code}', [\App\Http\Controllers\Auth\VerifyPhoneController::class, '__invoke'])
                ->name('verification.verify');
            Route::post('/phone/verification-notification', [\App\Http\Controllers\Auth\PhoneVerificationNotificationController::class, 'store'])
                ->name('verification.send');
        });

        Route::middleware('verified:seller.verification.notice')->group(function () {
            Route::get(RouteServiceProvider::HOME, \App\Http\Controllers\Seller\DashboardController::class)->name('dashboard');
            Route::post('sellership', \App\Http\Controllers\Seller\SellershipController::class)->name('sellership');
            Route::middleware('approved')->group(function () {
                Route::resource('products', \App\Http\Controllers\Seller\ProductController::class);
                Route::resource('orders', \App\Http\Controllers\Seller\OrderController::class);
            });
        });
    });
});
