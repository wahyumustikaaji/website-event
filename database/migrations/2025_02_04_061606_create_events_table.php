<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->foreignId('creator_id')->constrained('users')->onDelete('cascade'); // Relasi ke users (Pembuat event)
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Relasi ke categories (Kategori event)
            $table->foreignId('city_category_id')->constrained('city_categories')->onDelete('cascade'); // Relasi ke city_categories (Kategori kota)
            $table->string('location_name'); // Nama lokasi
            $table->string('address'); // Alamat lokasi
            $table->text('body');
            $table->dateTime('event_date'); // Tanggal dan waktu acara
            $table->dateTime('end_date')->nullable();
            $table->time('start_time'); // Jam mulai
            $table->time('end_time'); // Jam berakhir
            $table->integer('ticket_quantity')->default(0); // Jumlah tiket tersedia
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
