<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    use HasFactory;

    protected $table = 'servis'; // Nama tabel di database
    protected $primaryKey = 'idServis'; // Primary key

    protected $fillable = [
        'idMotor',
        'idMontir',
        'idSparepart',
        'tanggalServis',
        'totalHarga',
        'jumlahSparepart',
        'keluhan'
    ];

    public $timestamps = false;

    public function motor()
    {
        return $this->belongsTo(Motor::class, 'idMotor', 'idMotor');
    }

    public function montir()
    {
        return $this->belongsTo(Montir::class, 'idMontir', 'idMontir');
    }

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'idSparepart', 'idSparepart');
    }
}
