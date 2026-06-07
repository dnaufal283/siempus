<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    // 1. Kasih tau Laravel nama tabel aslinya biar nggak di-Inggris-in
    protected $table = 'pengumumans';

    // 2. Izin input data massal
    protected $guarded = ['id'];
}
