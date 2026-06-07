<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    // PERBAIKAN: Hapus $fillable, cukup gunakan $guarded agar tidak bentrok
    protected $guarded = ['id'];
}
