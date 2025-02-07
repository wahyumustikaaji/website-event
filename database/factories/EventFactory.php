<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use App\Models\CityCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Event::class;

    public function definition()
    {
        $title = $this->faker->sentence(4);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'image' => $this->faker->imageUrl(640, 480, 'events', true),
            'creator_id' => User::factory(), // Membuat user secara otomatis
            'category_id' => Category::factory(), // Membuat category secara otomatis
            'city_category_id' => CityCategory::factory(), // Membuat city_category secara otomatis
            'location_name' => $this->faker->city, // Nama lokasi (misalnya nama kota)
            'address' => $this->faker->address(), // Alamat lokasi
            'body' => $this->faker->paragraph(5),
            'event_date' => $this->faker->dateTimeBetween('now', '+1 year'), // Tanggal dan waktu acara
            'start_time' => $this->faker->time('H:i'), // Jam mulai
            'end_time' => $this->faker->time('H:i'), // Jam berakhir
            'ticket_quantity' => $this->faker->numberBetween(50, 500), // Jumlah tiket yang tersedia
        ];
    }
}
