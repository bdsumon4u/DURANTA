<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        foreach (range(0, 50) as $i) {
            $product = Product::factory()->for(Seller::findOrFail(1))->create();
            $product->categories()->sync(range(random_int(1, 20), random_int(25, 50)));
            $product->addMediaFromUrl('https://via.placeholder.com/512')->toMediaCollection();
        }
    }
}
