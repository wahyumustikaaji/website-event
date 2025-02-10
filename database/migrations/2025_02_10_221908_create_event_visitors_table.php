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
        Schema::create('event_visitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade'); // Relasi ke event
            $table->ipAddress('ip_address'); // Simpan IP pengunjung
            $table->string('country')->nullable(); // Negara
            $table->string('city')->nullable(); // Kota
            $table->string('device')->nullable(); // Perangkat (Mobile/Desktop)
            $table->string('browser')->nullable(); // Browser yang digunakan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_visitors');
    }
};
