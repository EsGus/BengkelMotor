<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarLayanan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'daftar_layanan';

    // Kolom yang dapat diisi dari form
    protected $fillable = [
        'nama',
        'no_handphone',
        'nomor_polisi',
        'tipe_motor',
        'tgl_rencana_servis', 
        'rencana_jam',
        'keluhan',
    ];

    // Format tampilan waktu otomatis
    public function getRencanaJamAttribute($value)
    {
        return date('H:i', strtotime($value));
    }
}
