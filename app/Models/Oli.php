<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oli extends Model
{
    use HasFactory;
    protected $table = 'oli';
    protected $primaryKey = 'idOli';
    public $timestamps = false;
    protected $fillable = ['namaOli', 'stok', 'harga', 'gambar'];
}