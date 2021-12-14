<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //

            'category_id' => Category::factory(),
            'purchase_price' => $this->faker->numberBetween(1000, 10000),
            'sale_price' => $this->faker->numberBetween(1000, 10000),
            'stock' => $this->faker->numberBetween(1, 20),
            'en' => [
                'name' => $this->faker->text(30),
                'description' => $this->faker->sentence()
            ]
        ];
    }
}
