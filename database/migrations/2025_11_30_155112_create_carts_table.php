<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');      // ID User Pemilik
            $table->unsignedBigInteger('product_id');   // ID Barang (sebelumnya id_produk)
            $table->string('product_type');             // Jenis: oli, ban, gear, sparepart
            $table->integer('qty')->default(1);         // Jumlah
            $table->timestamps();

            // Relasi ke tabel users (Hapus keranjang jika user dihapus)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};