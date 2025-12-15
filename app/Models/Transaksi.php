<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'user_id',
        'tanggal_transaksi',
        'total_harga',
        'biaya_admin',
        'metode_pembayaran',
        'status_pembayaran',
    ];

    /**
     * Relasi ke detail transaksi (1 transaksi punya banyak detail)
     */
    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }

    /**
     * Relasi ke user (setiap transaksi milik 1 user)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
