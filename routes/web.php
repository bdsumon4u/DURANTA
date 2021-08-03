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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get(RouteServiceProvider::HOME, \App\Http\Controllers\DashboardController::class)->name('dashboard');
    Route::get('user/password', \App\Http\Controllers\ChangePasswordController::class)->name('password.change');
    Route::get('/checkout', \App\Http\Controllers\CheckoutController::class)->name('checkout');
    Route::get('/addresses/{type}', \App\Http\Controllers\AddressController::class)
        ->where('type', 'home|office|billing')->name('address');
});
