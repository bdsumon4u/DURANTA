<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Hotash aDmiN',
                'password' => Hash::make('password'),
            ]
        );
    }
}
