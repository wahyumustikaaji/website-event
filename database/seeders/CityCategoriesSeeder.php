<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CityCategoriesSeeder extends Seeder
{
    public function run()
    {
        $cities = [
            ['name' => 'Jakarta', 'description' => 'Ibu kota Indonesia, pusat bisnis dan pemerintahan.', 'image' => 'https://t4.ftcdn.net/jpg/02/30/02/95/360_F_230029562_AfvY7qBL4aNANls52mWPKoou9SlRObfO.jpg'],
            ['name' => 'Bali', 'description' => 'Pulau wisata terkenal dengan pantai dan budayanya.', 'image' => 'https://img.freepik.com/premium-photo/pura-ulun-danu-bratan-hindu-temple-with-boat-bratan-lake-landscape-sunrise-bali-indonesia_29505-855.jpg?semt=ais_hybrid'],
            ['name' => 'Bandung', 'description' => 'Kota kembang dengan udara sejuk dan wisata belanja.', 'image' => 'https://wallpapersok.com/images/hd/west-java-provincial-government-bandung-53ne3806u2olrlnk.jpg'],
            ['name' => 'Surabaya', 'description' => 'Kota pahlawan dengan pelabuhan terbesar di Indonesia.', 'image' => 'https://t3.ftcdn.net/jpg/04/54/84/72/360_F_454847231_4GVHdDLYalg7t7hkB9TVq4CINyoGZbQe.jpg'],
            ['name' => 'Samarinda', 'description' => 'Ibukota Kalimantan Timur dengan Sungai Mahakam yang ikonik.', 'image' => 'https://c4.wallpaperflare.com/wallpaper/463/492/30/religious-samarinda-islamic-center-borneo-east-kalimantan-province-wallpaper-preview.jpg'],
            ['name' => 'Makassar', 'description' => 'Kota di Sulawesi Selatan yang terkenal dengan Pantai Losari.', 'image' => 'https://cdn1-production-images-kly.akamaized.net/92n8u027AIJFj-leo9dDKEH_sbU=/1200x675/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/3564493/original/006532300_1631062991-floating-mosque-6278398_1920.jpg'],
            ['name' => 'Palembang', 'description' => 'Kota di Sumatera Selatan dengan Jembatan Ampera yang ikonik.', 'image' => 'https://t4.ftcdn.net/jpg/02/99/09/05/360_F_299090527_n2chCeSRhq9BJMRoHUZxFDRmZmWJKNwy.jpg'],
            ['name' => 'Batam', 'description' => 'Kota industri dan perdagangan yang dekat dengan Singapura.', 'image' => 'https://www.shutterstock.com/image-photo/welcome-batam-hill-landmark-island-600nw-2121331877.jpg'],
        ];

        foreach ($cities as $city) {
            DB::table('city_categories')->insert([
                'name' => $city['name'],
                'slug' => Str::slug($city['name']),
                'description' => $city['description'],
                'image' => $city['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
