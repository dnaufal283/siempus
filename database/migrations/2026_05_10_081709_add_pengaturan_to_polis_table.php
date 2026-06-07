<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Ingat, pakai Schema::table ya, bukan Schema::create
        Schema::table('polis', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('deskripsi');
            $table->integer('kuota')->default(50)->after('is_active');
        });
    }

    public function down()
    {
        Schema::table('polis', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'kuota']);
        });
    }
};
