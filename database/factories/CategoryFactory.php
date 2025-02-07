<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Category::class;

    public function definition()
    {
        $name = $this->faker->unique()->word();
        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(),
            'icon' => '<svg class="shrink-0 size-10 mb-3 text-pink-500" xmlns="http://www.w3.org/2000/svg" width="400" height="400" viewBox="0 0 24 24"> <path fill="currentColor" d="M22 11a4 4 0 0 0-2-3.48A3 3 0 0 0 20 7a3 3 0 0 0-3-3h-.18A3 3 0 0 0 12 2.78A3 3 0 0 0 7.18 4H7a3 3 0 0 0-3 3a3 3 0 0 0 0 .52a4 4 0 0 0-.55 6.59A4 4 0 0 0 7 20h.18A3 3 0 0 0 12 21.22A3 3 0 0 0 16.82 20H17a4 4 0 0 0 3.5-5.89A4 4 0 0 0 22 11M11 8.55a5 5 0 0 0-.68-.32a1 1 0 0 0-.64 1.9A2 2 0 0 1 11 12v1.55a5 5 0 0 0-.68-.32a1 1 0 0 0-.64 1.9A2 2 0 0 1 11 17v2a1 1 0 0 1-1 1a1 1 0 0 1-.91-.6a4 4 0 0 0 .48-.33a1 1 0 1 0-1.28-1.54A2 2 0 0 1 7 18a2 2 0 0 1-2-2a2 2 0 0 1 .32-1.06A4 4 0 0 0 6 15a1 1 0 0 0 0-2a1.8 1.8 0 0 1-.69-.13A2 2 0 0 1 5 9.25a3 3 0 0 0 .46.35a1 1 0 1 0 1-1.74a.9.9 0 0 1-.34-.33A.9.9 0 0 1 6 7a1 1 0 0 1 1-1a.8.8 0 0 1 .21 0a4 4 0 0 0 .19.47a1 1 0 0 0 1.37.37a1 1 0 0 0 .36-1.34A1.06 1.06 0 0 1 9 5a1 1 0 0 1 2 0Zm7.69 4.32A1.8 1.8 0 0 1 18 13a1 1 0 0 0 0 2a4 4 0 0 0 .68-.06A2 2 0 0 1 19 16a2 2 0 0 1-2 2a2 2 0 0 1-1.29-.47a1 1 0 0 0-1.28 1.54a4 4 0 0 0 .48.33a1 1 0 0 1-.91.6a1 1 0 0 1-1-1v-2a2 2 0 0 1 1.32-1.87a1 1 0 0 0-.64-1.9a5 5 0 0 0-.68.32V12a2 2 0 0 1 1.32-1.87a1 1 0 0 0-.64-1.9a5 5 0 0 0-.68.32V5a1 1 0 0 1 2 0a1.06 1.06 0 0 1-.13.5a1 1 0 0 0 .36 1.37a1 1 0 0 0 1.37-.37a4 4 0 0 0 .19-.5a.8.8 0 0 1 .21 0a1 1 0 0 1 1 1a1 1 0 0 1-.17.55a.9.9 0 0 1-.33.31a1 1 0 0 0 1 1.74a2.7 2.7 0 0 0 .5-.35a2 2 0 0 1-.27 3.62Z" /> </svg>',
            'image' => $this->faker->imageUrl(640, 480, 'city', true),
        ];
    }
}
