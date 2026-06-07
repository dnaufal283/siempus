<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel users untuk urusan login
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Data medis dan biodata
            $table->string('nik', 16)->unique();
            $table->string('no_bpjs')->nullable(); // nullable = boleh kosong
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_hp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
