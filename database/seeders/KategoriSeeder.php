<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        // Pindahkan semua kode pembuatan kategori ke sini
        Kategori::create(['nama_kategori' => 'Oli', 'keterangan' => 'Pelumas Mesin']);
        Kategori::create(['nama_kategori' => 'Ban', 'keterangan' => 'Ban Tubeless & Biasa']);
        Kategori::create(['nama_kategori' => 'Sparepart', 'keterangan' => 'Suku cadang asli']);
        Kategori::create(['nama_kategori' => 'Gear', 'keterangan' => 'Gear set & Rantai']);
        Kategori::create(['nama_kategori' => 'Jasa', 'keterangan' => 'Biaya Pemasangan/Servis']);
    }
}