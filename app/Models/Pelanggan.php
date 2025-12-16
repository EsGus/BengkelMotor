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
        'nama_pelanggan',
        'no_hp',
        'alamat',
        'jenis_motor', 
        'namaPelanggan', // <-- Tambahkan jika Anda punya kolom namaPelanggan manual
        'no_polisi',
    ];

    // --- TAMBAHKAN INI ---
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}