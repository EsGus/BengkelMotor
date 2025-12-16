<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    use HasFactory;

    protected $table = 'servis'; 
    protected $primaryKey = 'idServis'; 

    protected $fillable = [
        'nama_pelanggan', // BARU
        'no_hp',          // BARU
        'idMotor',
        'idMontir',
        'idSparepart',
        'tanggalServis',
        'totalHarga',
        'jumlahSparepart',
        'keluhan'
    ];

    public $timestamps = true; // Set true karena ada timestamps() di migrasi

    public function motor()
    {
        return $this->belongsTo(Motor::class, 'idMotor');
    }

    public function montir()
    {
        return $this->belongsTo(Montir::class, 'idMontir');
    }

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'idSparepart', 'idSparepart');
    }
}