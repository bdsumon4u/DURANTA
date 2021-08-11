<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::firstOrCreate(
            ['phone' => '01783110247'],
            [
                'name' => 'Hotash Seller',
                'password' => Hash::make('password'),
            ]
        );
    }
}
