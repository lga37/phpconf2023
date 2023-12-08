<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{



    public function definition()
    {
        $name = fake()->name();
        return
        [
            'name' => $name,
            'slug' => Str::slug($name),
            'price' => fake()->numberBetween(20, 2000),
            'img' => fake()->imageUrl(200,200),
            'category_id' => fake()->randomElement(Category::pluck('id')),
        ];
    }



}
