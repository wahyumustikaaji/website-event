<?php

namespace Database\Factories;

use App\Models\CityCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CityCategory>
 */
class CityCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CityCategory::class;

    public function definition()
    {
        $name = $this->faker->city;

        return [
            'name' => $name,
            'slug' => Str::slug($name), // Placeholder icon URL
            'description' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(640, 480, 'city', true), // Placeholder image URL
        ];
    }
}
