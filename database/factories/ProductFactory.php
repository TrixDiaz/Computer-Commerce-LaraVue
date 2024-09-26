<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Series;
use App\Models\User;
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
    public function definition(): array
    {
        return [
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'series_id' => Series::inRandomOrder()->first()->id,

            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'sale_price' => $this->faker->randomFloat(2, 1, 1000),
            'image' => null,
            'hover_image' => null,
            'stocks' => $this->faker->numberBetween(1, 100),
         
            'is_active' => $this->faker->boolean,
            'is_featured' => $this->faker->boolean,
            'is_sale' => $this->faker->boolean,
            'is_new' => $this->faker->boolean,
            
             'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
             'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
