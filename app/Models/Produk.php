<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk'; 
    protected $primaryKey = 'id_produk';
    protected $guarded = [];
// Sesuaikan dengan nama tabel di database jika tidak standar (opsional)
    // protected $table = 'produks'; 
    

    // IZINKAN KOLOM INI DIISI OLEH CONTROLLER
    protected $fillable = [
        'nama_produk',
        'id_kategori',
        'harga',
        'stok',
        'gambar'
    ];
}