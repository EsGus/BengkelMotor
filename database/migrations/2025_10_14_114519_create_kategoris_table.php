<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration // <-- Hanya class anonim yang boleh
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mengubah 'kategoris' menjadi 'kategori' dan menambahkan kolom yang dibutuhkan
        Schema::create('kategori', function (Blueprint $table) {
            $table->id('id_kategori'); // Primary key
            $table->string('nama_kategori', 50)->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->string('deskripsi', 100)->nullable();
            // Kolom timestamps() tidak kita perlukan untuk tabel ini
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Juga ubah ini menjadi 'kategori'
        Schema::dropIfExists('kategori');
    }
};