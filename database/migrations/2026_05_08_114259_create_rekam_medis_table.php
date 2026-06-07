<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel antrean dan user
            $table->foreignId('antrean_id')->constrained('antreans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Data Pemeriksaan
            $table->string('tensi')->nullable();
            $table->string('suhu')->nullable();
            $table->text('keluhan');
            $table->text('diagnosa');
            $table->text('resep_obat');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
