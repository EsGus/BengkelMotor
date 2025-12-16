<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    // Nama tabel di database (sesuai migrasi Anda)
    protected $table = 'motors'; 
    
    // Kolom yang boleh diisi
    protected $guarded = [];
}