<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gear extends Model
{
    use HasFactory;

    protected $table = 'gear';       // Mengarah ke tabel 'gear' yang baru kita buat
    protected $primaryKey = 'idGear'; // Primary key-nya 'idGear'
    public $timestamps = false;      // Tidak pakai created_at/updated_at

    protected $fillable = [
        'namaGear',  // Perhatikan ini pakai namaGear, bukan namaSparepart
        'stok',
        'harga',
        'gambar'
    ];
}