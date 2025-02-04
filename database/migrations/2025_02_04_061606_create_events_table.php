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
            $table->foreignId('creator_id')->constrained('users')->onDelete('cascade'); // Pembuat event
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Kategori event
            $table->string('location_name'); // Nama lokasi
            $table->string('address'); // Alamat lokasi
            $table->text('body');
            $table->dateTime('event_date'); // Tanggal dan waktu acara
            $table->time('start_time'); // Jam mulai
            $table->time('end_time'); // Jam berakhir
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
