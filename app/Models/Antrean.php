<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrean extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar data bisa masuk ke database:
    protected $fillable = [
        'user_id',
        'poli',
        'nomor_antrean',
        'tanggal_periksa',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class, 'antrean_id');
    }
}
