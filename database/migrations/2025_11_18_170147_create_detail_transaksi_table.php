<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('detail_transaksi', function (Blueprint $table) {
        $table->id();
        
        // Relasi ke tabel transaksi utama
        // Kita gunakan unsignedBigInteger saja biar aman dari error 1215
        $table->unsignedBigInteger('id_transaksi'); 
        
        // PERBAIKAN DI SINI:
        // Jangan pakai foreign key ke 'produk'. Cukup simpan ID-nya saja.
        $table->unsignedBigInteger('id_produk'); 
        
        // Tambahkan kolom ini agar tahu barangnya diambil dari tabel mana (oli/ban/gear/sparepart)
        $table->string('jenis_produk')->default('sparepart'); 
        
        $table->integer('jumlah');
        $table->decimal('harga_saat_transaksi', 12, 2);
        $table->decimal('subtotal', 12, 2);
        
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};