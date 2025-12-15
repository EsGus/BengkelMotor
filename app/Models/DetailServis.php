<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailServis extends Model
{
    use HasFactory;

    protected $table = 'detailservis';
    protected $primaryKey = 'idTransaksi';
    public $timestamps = false; // karena tidak ada kolom created_at dan updated_at

    protected $fillable = [
        'idServis',
        'hargaTransaksiServis',
        'jumlahJualSparepart',
        'tanggalTransaksi',
    ];
}
