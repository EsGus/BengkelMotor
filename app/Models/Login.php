<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // KOREKSI KRITIS: Tentukan Primary Key yang sebenarnya
    protected $primaryKey = 'id_kategori'; 

    // Asumsi: Nama tabel kategori di migration adalah 'kategori'
    protected $table = 'kategori'; 
    
    // Asumsi: Kolom yang boleh diisi
    protected $fillable = ['nama_kategori', 'keterangan', 'deskripsi'];

    // Jika Anda tidak memiliki timestamps di migration kategori:
    public $timestamps = false; 
}