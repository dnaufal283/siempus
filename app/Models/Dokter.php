<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = ['nama_dokter', 'poli_id', 'no_telp'];

    // Relasi: Satu Dokter dimiliki oleh Satu Poli
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
}
