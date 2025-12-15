<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kita buat nama tabelnya 'ban' (TUNGGAL) biar seragam dengan oli & gear
        Schema::create('ban', function (Blueprint $table) {
            $table->id('idBan'); // Primary Key custom
            $table->string('namaBan', 100);
            $table->integer('stok');
            $table->decimal('harga', 12, 2);
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ban');
    }
};