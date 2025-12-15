<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('spareparts', function (Blueprint $table) {
            $table->id('idSparepart'); // Primary Key
            $table->string('namaSparepart', 100);
            $table->integer('stok');
            $table->decimal('harga', 12, 2);
            $table->string('gambar')->nullable();
            
            // HAPUS BAGIAN id_kategori DAN FOREIGN KEY DI SINI
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spareparts');
    }
};