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
        Schema::create('data_harian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->foreignId('komoditas_id')->constrained('komoditas')->onDelete('cascade'); // Relasi ke tabel komoditas
            $table->foreignId('responden_id')->constrained('respondens')->onDelete('cascade'); // Relasi ke tabel respondens
            $table->date('tanggal'); // Kolom untuk tanggal
            $table->boolean('status')->default(false); // Status (true/false)
            $table->string('data_input'); // Kolom untuk data input berupa string
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_harian');
    }
};
