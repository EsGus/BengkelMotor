<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // Izinkan kolom ini diisi massal
    protected $fillable = [
        'nama', 
        'jabatan', 
        'email', 
        'foto'
    ];
}