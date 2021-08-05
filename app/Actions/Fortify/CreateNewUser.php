<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\Seller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        switch (request()->segment(1)) {
            case 'admin':
                $table = 'admins';
                $model = Admin::class;
                break;
            case 'seller':
                $table = 'sellers';
                $model = Seller::class;
                break;
            default:
                $table = 'users';
                $model = User::class;
        }

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'digits:11',  Rule::unique($table)],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return DB::transaction(function () use ($input, $model) {
            return tap($model::create([
                'name' => $input['name'],
                'phone' => $input['phone'],
                'password' => Hash::make($input['password']),
            ]), function ($user) {
                if (method_exists($user, 'personalTeam')) {
                    $this->createTeam($user);
                }
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
