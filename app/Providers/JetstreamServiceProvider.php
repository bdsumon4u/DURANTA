<?php

namespace App\Providers;

use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\InviteTeamMember;
use App\Actions\Jetstream\RemoveTeamMember;
use App\Actions\Jetstream\UpdateTeamName;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\JetstreamServiceProvider as ServiceProvider;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (request()->isAdmin() || request()->isSeller()) {
            config(['jetstream.features' => array_filter(
                config('jetstream.features'),
                static function ($feature) {
                    return $feature !== Features::teams();
                },
            )]);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);
        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);

        foreach (['admin', 'seller'] as $type) {
            Route::group(['middleware' => ['web', 'auth:'.$type], 'prefix' => $type, 'as' => "$type."], function () {
                $this->configureRoutes();
            });
        }

        switch (request()->segment(1)) {
            case 'admin': $typeDir = 'Admin/'; break;
            case 'seller': $typeDir = 'Seller/'; break;
            default: $typeDir = '';
        }

        Fortify::registerView(function () use ($typeDir) {
            if ($typeDir === 'Admin/') {
                return redirect()->route('admin.dashboard');
            }

            return Inertia::render('Auth/Register');
        });

        Fortify::loginView(function () use ($typeDir) {
            return Inertia::render($typeDir . 'Auth/Login', [
                'canResetPassword' => Route::has('' . 'password.request'),
                'status' => session('status'),
            ]);
        });

        Fortify::twoFactorChallengeView(function () use ($typeDir) {
            return Inertia::render($typeDir . 'Auth/TwoFactorChallenge');
        });

        Fortify::requestPasswordResetLinkView(function () use ($typeDir) {
            return Inertia::render($typeDir . 'Auth/ForgotPassword', [
                'status' => session('session'),
            ]);
        });

        Fortify::resetPasswordView(function () use ($typeDir) {
            return Inertia::render($typeDir . 'Auth/ResetPassword', [
                'email' => request('email'),
                'token' => request('token'),
            ]);
        });

        Fortify::verifyEmailView(function () use ($typeDir) {
            return Inertia::render($typeDir . 'Auth/VerifyEmail', [
                'status' => session('status'),
            ]);
        });

        Fortify::confirmPasswordView(function () use ($typeDir) {
            return Inertia::render($typeDir . 'Auth/ConfirmPassword');
        });
    }

    /**
     * Configure the roles and permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', __('Administrator'), [
            'create',
            'read',
            'update',
            'delete',
        ])->description(__('Administrator users can perform any action.'));

        Jetstream::role('editor', __('Editor'), [
            'read',
            'create',
            'update',
        ])->description(__('Editor users have the ability to read, create, and update.'));
    }
}
