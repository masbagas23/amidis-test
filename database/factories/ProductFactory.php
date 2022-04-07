<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'stock' => rand(1,90),
            'unit' => substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,4),
            'location_id' => rand(1,10)
        ];
    }
}
