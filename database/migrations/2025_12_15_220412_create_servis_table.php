<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servis', function (Blueprint $table) {
            $table->id('idServis'); // Primary Key
            
            // --- BAGIAN BARU: DATA PELANGGAN ---
            $table->string('nama_pelanggan'); 
            $table->string('no_hp');
            
            // --- DATA TEKNIS ---
            $table->unsignedBigInteger('idMotor')->nullable();
            $table->unsignedBigInteger('idMontir')->nullable();
            $table->unsignedBigInteger('idSparepart')->nullable();
            
            $table->date('tanggalServis');
            $table->decimal('totalHarga', 12, 2)->default(0);
            $table->integer('jumlahSparepart')->default(0);
            $table->text('keluhan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servis');
    }
};