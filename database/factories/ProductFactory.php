<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        $name = $this->faker->sentence();
        return [
            'sku' => Str::random(random_int(6, 8)),
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => implode("\n", $this->faker->paragraphs(random_int(3, 5))),

            'brand_id' => mt_rand(1, 25),

            'price' => random_int(500, 1500),
            'discount_amount' => mt_rand(5, 10),
            'discount_type' => ['fixed', 'percent'][mt_rand(0, 1)],

            'stock_track' => mt_rand(0, 1),
            'stock_count' => mt_rand(10, 50),
            'pickup_point' => $this->faker->address(),
        ];
    }
}
