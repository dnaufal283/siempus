<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $fillable = [
        'antrean_id',
        'user_id',
        'tensi',
        'suhu',
        'keluhan',
        'diagnosa',
        'resep_obat',
    ];

    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class, 'antrean_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function antrean()
    {
        return $this->belongsTo(Antrean::class);
    }
}
