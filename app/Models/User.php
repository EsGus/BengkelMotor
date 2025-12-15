<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi (mass assignable).
     */
    protected $fillable = [
        'name',  // <-- TAMBAHKAN KOLOM NAME
        'username',
        'password',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi (misal saat dikirim ke JSON).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tipe data atau atribut yang akan di-cast otomatis.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed', // auto hash saat diset
        ];
    }
}
