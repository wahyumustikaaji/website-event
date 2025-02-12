<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    public function run()
    {

        // SVG Icon
        $icon = '<svg class="shrink-0 size-10 mb-3 text-blue-500" xmlns="http://www.w3.org/2000/svg" width="400" height="400" viewBox="0 0 32 32"><g fill="currentColor"><path d="M24 19a3 3 0 1 0 0-6a3 3 0 0 0 0 6m0-1a2 2 0 1 1 0-4a2 2 0 0 1 0 4m-7.5-9.25a2.25 2.25 0 1 1-4.5 0a2.25 2.25 0 0 1 4.5 0m-6 4a2.25 2.25 0 1 1-4.5 0a2.25 2.25 0 0 1 4.5 0M8.25 22a2.25 2.25 0 1 0 0-4.5a2.25 2.25 0 0 0 0 4.5M16 24.25a2.25 2.25 0 1 1-4.5 0a2.25 2.25 0 0 1 4.5 0" /><path d="M16.2 31a16.7 16.7 0 0 1-7.84-2.622a15.05 15.05 0 0 1-6.948-9.165A13.03 13.03 0 0 1 2.859 9.22c3.757-6.2 12.179-8.033 19.588-4.256c4.419 2.255 7.724 6.191 8.418 10.03a6.8 6.8 0 0 1-1.612 6.02c-2.158 2.356-4.943 2.323-6.967 2.3h-.007c-1.345-.024-2.185 0-2.386.4c.07.308.192.604.36.873a3.916 3.916 0 0 1-.209 4.807A4.7 4.7 0 0 1 16.2 31M14.529 5a11.35 11.35 0 0 0-9.961 5.25a11.05 11.05 0 0 0-1.218 8.473a13.03 13.03 0 0 0 6.03 7.934c3.351 1.988 7.634 3.3 9.111 1.473c.787-.968.537-1.565-.012-2.622a2.84 2.84 0 0 1-.372-2.7c.781-1.54 2.518-1.523 4.2-1.5c1.835.025 3.917.05 5.472-1.649a4.91 4.91 0 0 0 1.12-4.314c-.578-3.2-3.536-6.653-7.358-8.6a15.5 15.5 0 0 0-7.01-1.74z" /></g></svg>';

        // Data kategori
        $categories = [
            ['name' => 'Pameran', 'description' => 'Berbagai pameran seni dan inovasi.', 'image' => 'https://images.pexels.com/photos/1839919/pexels-photo-1839919.jpeg?cs=srgb&dl=pexels-julioneryy-1839919.jpg&fm=jpg'],
            ['name' => 'Teater', 'description' => 'Pertunjukan teater dan drama berkualitas.', 'image' => 'https://warta.jogjakota.go.id/assets/instansi/warta/article/20230904110354.jpg'],
            ['name' => 'Musik & Konser', 'description' => 'Konser musik dari berbagai genre.', 'image' => 'https://decode.uai.ac.id/wp-content/uploads/2022/06/konser1.jpg'],
            ['name' => 'Sastra & Puisi', 'description' => 'Acara sastra dan puisi dari berbagai penulis.', 'image' => 'https://www.gentaandalas.com/wp-content/uploads/2022/11/IMG20221112223320-scaled-e1668320563913.jpg'],
            ['name' => 'Fashion', 'description' => 'Event fashion dan peragaan busana.', 'image' => 'https://www.blibli.com/friends-backend/wp-content/uploads/2023/10/B900515-Cover-fashion-show-terbesar-di-dunia-scaled.jpg'],
            ['name' => 'Workshop', 'description' => 'Workshop interaktif dengan berbagai topik.', 'image' => 'https://vcube.co.id/wp-content/uploads/2020/07/online-event.jpg'],
            ['name' => 'Budaya', 'description' => 'Event budaya dari berbagai daerah.', 'image' => 'https://kemenparekraf.go.id/_next/image?url=https%3A%2F%2Fapi2.kemenparekraf.go.id%2Fstorage%2Fapp%2Fuploads%2Fpublic%2F666%2F7ba%2Fad3%2F6667baad322f2201557423.jpg&w=3840&q=75'],
            ['name' => 'Komedi', 'description' => 'Pertunjukan komedi yang menghibur.', 'image' => 'https://www.blibli.com/friends-backend/wp-content/uploads/2024/02/B110205-Cover-scaled.jpg'],
        ];

        // Insert data
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'icon' => $icon,
                'description' => $category['description'],
                'image' => $category['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
