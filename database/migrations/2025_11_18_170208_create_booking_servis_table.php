<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_servis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('no_hp');
            $table->string('nopol');
            $table->string('tipe_motor');
            $table->date('tgl_servis');
            $table->string('jam_servis');
            $table->text('keluhan')->nullable();
            
            // UPDATE: Tambahkan 'Proses' dan 'Ditolak' ke dalam ENUM
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai', 'Ditolak'])->default('Menunggu'); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_servis');
    }
};