<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    // Izinkan form untuk mengisi semua kolom, kecuali kolom 'id'
    protected $guarded = ['id'];
}
