<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Admin;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\FortifyServiceProvider as ServiceProvider;
use Laravel\Fortify\Http\Requests\LoginRequest;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (\request()->isAdmin()) {
            config(['fortify.guard' => 'admin']);
            config(['fortify.passwords' => 'admins']);
        }
        if (\request()->isSeller()) {
            config(['fortify.guard' => 'seller']);
            config(['fortify.passwords' => 'sellers']);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        $context = require base_path('routes/fortify.php');
        collect(['admin', 'seller'])->each(function ($type) use ($context) {
            Route::group(['middleware' => ['web'], 'prefix' => $type, 'as' => "$type."], fn () => $context(['guard' => $type]));
        });


        Fortify::authenticateUsing(function (LoginRequest $request) {
            switch ($request->segment(1)) {
                case 'admin': $model = Admin::class; break;
                case 'seller': $model = Seller::class; break;
                default: $model = User::class;
            }

            $user = $model::where('email', $request->email)
                ->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
        });
    }
}
