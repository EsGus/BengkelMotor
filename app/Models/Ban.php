<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    use HasFactory;
    protected $table = 'ban';
    protected $primaryKey = 'idBan';
    public $timestamps = false;
    protected $fillable = ['namaBan', 'stok', 'harga', 'gambar'];
}