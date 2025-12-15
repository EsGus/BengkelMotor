<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Pastikan nama tabel benar (biasanya 'carts')
    protected $table = 'carts';

    // WAJIB ADA: Agar data bisa diisi lewat Controller
    protected $fillable = [
        'user_id',
        'product_id',
        'product_type',
        'qty'
    ];
}