<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_obat')->unique(); // Contoh: OBT-001
            $table->string('nama_obat');           // Contoh: Amoxicillin
            $table->string('kategori');            // Contoh: Tablet/Sirup
            $table->integer('stok')->default(0);   // Jumlah stok
            $table->string('satuan');              // Contoh: Strip/Botol
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
