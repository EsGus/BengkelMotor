<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';

    protected $fillable = [
        'user_id',
        'no_hp',
        'alamat',
        'jenis_motor', // <-- Pastikan ada
        'no_polisi',   // <-- Pastikan ada
    ];
}