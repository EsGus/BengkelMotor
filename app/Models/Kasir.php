<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;

    protected $table = 'kasir';       // Nama tabel di database
    protected $primaryKey = 'idKasir'; // Primary key
    public $timestamps = false;       

    protected $fillable = [
        'namaKasir',
        'noTelp'
    ];
}
