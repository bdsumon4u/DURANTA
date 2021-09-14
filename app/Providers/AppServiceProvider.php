<?php

namespace App\Providers;

use App\Passwords\PasswordBrokerManager;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Request::macro('isAdmin', function () {
            return $this->segment(1) === 'admin';
        });
        Request::macro('isSeller', function () {
            return $this->segment(1) === 'seller';
        });
        $this->app->extend('auth.password', function ($service, $app) {
            return new PasswordBrokerManager($app);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        (require base_path('routes/fortify.php'))([]);
        (require base_path('routes/jetstream.php'))([]);
    }
}
