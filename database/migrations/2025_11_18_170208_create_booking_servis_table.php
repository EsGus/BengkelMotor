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
        $table->string('nopol'); // Nomor Polisi
        $table->string('tipe_motor');
        $table->date('tgl_servis');
        $table->string('jam_servis'); // Gabungan Jam + Menit
        $table->text('keluhan')->nullable();
        $table->enum('status', ['Menunggu', 'Selesai'])->default('Menunggu'); // Status pengerjaan
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('booking_servis');
    }
};