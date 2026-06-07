<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik',
        'no_bpjs',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
    ];

    public function user()
    {
        // Pasien dimiliki oleh satu User
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
