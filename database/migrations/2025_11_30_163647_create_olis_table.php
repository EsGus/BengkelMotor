<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Nama tabel 'oli' (sesuai Model protected $table = 'oli')
        Schema::create('oli', function (Blueprint $table) {
            $table->id('idOli'); // Primary Key
            $table->string('namaOli', 100);
            $table->integer('stok');
            $table->decimal('harga', 12, 2);
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oli');
    }
};