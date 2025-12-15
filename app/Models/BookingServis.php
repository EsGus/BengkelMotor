<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingServis extends Model
{
    use HasFactory;
    protected $table = 'booking_servis';
    protected $fillable = [
        'nama_pelanggan', 'no_hp', 'nopol', 'tipe_motor', 
        'tgl_servis', 'jam_servis', 'keluhan', 'status'
    ];
}