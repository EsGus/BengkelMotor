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
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            
            // 1. User ID dibuat NULLABLE
            // Tujuannya: Agar admin bisa input pelanggan umum yang TIDAK punya akun.
            $table->unsignedBigInteger('user_id')->nullable(); 
            
            // 2. Kolom nama_pelanggan (WAJIB ADA)
            // Tujuannya: Menyimpan nama manual untuk pelanggan umum.
            $table->string('nama_pelanggan'); 
            
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('jenis_motor');
            $table->string('no_polisi');
            
            $table->timestamps();

            // 3. Foreign Key dengan 'set null'
            // Tujuannya: Jika akun user dihapus, data riwayat servis pelanggan TIDAK ikut terhapus,
            // melainkan user_id nya saja yang jadi null.
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};