<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    protected $fillable = [
        'id_transaksi',
        'id_produk',
        'jenis_produk',
        'jumlah',
        'harga_saat_transaksi',
        'subtotal',
    ];

    /**
     * Relasi ke tabel transaksi
     * Setiap detail transaksi pasti milik 1 transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    /**
     * Relasi ke produk (opsional, jika tabel produk ada)
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
