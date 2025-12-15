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
        Schema::create('produk', function (Blueprint $table) {
            $table->id(); // Primary key

            // Foreign key yang terhubung ke tabel 'kategori'
            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('set null');

            $table->string('nama_produk', 100)->nullable();
            $table->decimal('harga', 10, 2)->nullable();
            $table->integer('stok')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // PERBAIKAN: Mengubah 'produks' menjadi 'produk'
        Schema::dropIfExists('produk');
    }
};