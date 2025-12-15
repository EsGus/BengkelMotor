<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;

    // Pastikan sesuai dengan nama tabel yang kamu punya
    protected $table = 'spareparts';   // ← WAJIB DITAMBAHKAN

    // Primary key
    protected $primaryKey = 'idSparepart';

    protected $fillable = [
        'namaSparepart',
        'stok',
        'harga',
        'gambar'
    ];

    // Jika tidak ada created_at dan updated_at
    public $timestamps = false;
}
