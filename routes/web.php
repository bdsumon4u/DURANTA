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

Route::get('/phone/verify', [\App\Http\Controllers\Auth\PhoneVerificationPromptController::class, '__invoke'])
    ->middleware(['auth'])
    ->name('phone.verification.notice');
Route::get('/phone/verify/{id}/{code}', [\App\Http\Controllers\Auth\VerifyPhoneController::class, '__invoke'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('phone.verification.verify');
Route::post('/phone/verification-notification', [\App\Http\Controllers\Auth\PhoneVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('phone.verification.send');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get(RouteServiceProvider::HOME, \App\Http\Controllers\DashboardController::class)->name('dashboard');
    Route::get('user/password', \App\Http\Controllers\ChangePasswordController::class)->name('password.change');
    Route::get('/checkout', \App\Http\Controllers\CheckoutController::class)->name('checkout');
    Route::get('/addresses/{type}', \App\Http\Controllers\AddressController::class)
        ->where('type', 'home|office|billing')->name('address');
});
