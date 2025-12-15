<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // PENTING: Nama tabel 'gear' (tunggal) sesuai dengan Model Gear.php kamu
        Schema::create('gear', function (Blueprint $table) {
            $table->id('idGear'); // Primary Key
            $table->string('namaGear', 100);
            $table->integer('stok');
            $table->decimal('harga', 12, 2);
            $table->string('gambar')->nullable();
            $table->timestamps(); // Created_at & Updated_at (Optional, tapi bagus ada)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gear');
    }
};