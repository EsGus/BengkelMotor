<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            // Kita hubungkan dengan tabel users
            $table->unsignedBigInteger('user_id'); 
            
            $table->string('no_hp');
            $table->text('alamat');
            
            // TAMBAHKAN DUA KOLOM INI AGAR TIDAK ERROR
            $table->string('jenis_motor')->nullable(); 
            $table->string('no_polisi')->nullable();
            
            $table->timestamps();

            // Foreign key (Opsional, biar aman)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};