<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');
Route::get('/products', \App\Http\Controllers\ProductController::class)->name('products');
Route::get('/products/{slug}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/brands', \App\Http\Controllers\BrandController::class)->name('brands');
Route::get('/brands/{brand:slug}', [\App\Http\Controllers\BrandController::class, 'show'])->name('brands.show');
Route::get('/sellers', \App\Http\Controllers\SellerController::class)->name('sellers');
Route::get('/sellers/{slug}', [\App\Http\Controllers\SellerController::class, 'show'])->name('sellers.show');
Route::get('/categories', \App\Http\Controllers\CategoryController::class)->name('categories');
Route::get('/categories/{category:slug}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');

notificationRoutes(['middleware' => ['web', 'auth:sanctum']]);

Route::post('/payment/{order}/success', [\App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
Route::post('/payment/{order}/fail', [\App\Http\Controllers\PaymentController::class, 'fail'])->name('payment.fail');
Route::post('/payment/{order}/cancel', [\App\Http\Controllers\PaymentController::class, 'cancel'])->name('payment.cancel');
Route::post('/payment/{order}/ipn', [\App\Http\Controllers\PaymentController::class, 'ipn'])->name('payment.ipn');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/phone/verify', [\App\Http\Controllers\Auth\PhoneVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');
    Route::middleware('throttle:6,1',)->group(function () {
        Route::get('/phone/verify/{id}/{code}', [\App\Http\Controllers\Auth\VerifyPhoneController::class, '__invoke'])
            ->name('verification.verify');
        Route::post('/phone/verification-notification', [\App\Http\Controllers\Auth\PhoneVerificationNotificationController::class, 'store'])
            ->name('verification.send');
    });
    Route::middleware('verified')->group(function () {
        Route::get(RouteServiceProvider::HOME, \App\Http\Controllers\DashboardController::class)->name('dashboard');
        Route::get('user/password', \App\Http\Controllers\ChangePasswordController::class)->name('password.change');
        Route::get('/orders/complete', \App\Http\Controllers\CheckoutController::class)->name('orders.complete');
        Route::resource('/orders', \App\Http\Controllers\OrderController::class);
        Route::match(['get', 'post'],'/addresses/{type}', \App\Http\Controllers\AddressController::class)
            ->where('type', 'home|office|billing')->name('address');

        Route::post('/orders/{order}/payments', [\App\Http\Controllers\OrderPaymentController::class, 'store'])->name('orders.payments.store');
    });
});
