<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function ($router) {
    Route::redirect('/', $router->getLastGroupPrefix() . RouteServiceProvider::HOME);

    Route::group(['middleware' => ['auth:admin', 'verified'], 'as' => 'admin.'], function () {
        Route::get(RouteServiceProvider::HOME, \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');
        Route::match(['get', 'post'], '/settings/{tab?}', \App\Http\Controllers\Admin\SettingController::class)->name('settings');
        Route::resource('brands', \App\Http\Controllers\Admin\BrandController::class);
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    });
});
