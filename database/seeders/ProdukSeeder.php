<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Oli;
use App\Models\Ban;
use App\Models\Gear;
use App\Models\Sparepart;
use App\Models\Produk; // Opsional jika tabel produks masih ada

class ProdukSeeder extends Seeder // <--- PASTIKAN NAMANYA INI
{
    public function run(): void
    {
        // 1. OLI
        Oli::create([
            'namaOli' => 'MOTUL Oil Motor SCOOTER POWER LE',
            'stok' => 20,
            'harga' => 62000,
            'gambar' => 'oli1.png'
        ]);
        
        Oli::create([
            'namaOli' => 'Shell Advance AX7 Scooter',
            'stok' => 25,
            'harga' => 55000,
            'gambar' => 'oli2.png'
        ]);

        // 2. BAN
        Ban::create([
            'namaBan' => 'FDR TL GENZI PRO Ring 14',
            'stok' => 15,
            'harga' => 212000,
            'gambar' => 'ban1.png'
        ]);

        Ban::create([
            'namaBan' => 'IRC Tubeless Ring 14',
            'stok' => 15,
            'harga' => 195000,
            'gambar' => 'ban2.png'
        ]);

        // 3. GEAR
        Gear::create([
            'namaGear' => 'Gear Set Girset Komplit Honda',
            'stok' => 10,
            'harga' => 126500,
            'gambar' => 'gear1.png'
        ]);

        // 4. SPAREPART
        for ($i = 1; $i <= 8; $i++) {
            Sparepart::create([
                'namaSparepart' => 'Suku Cadang Motor Generik ' . $i,
                'stok' => 15,
                'harga' => 50000 + ($i * 10000), 
                'gambar' => 'spar' . $i . '.png'
            ]);
        }

        // 5. JASA (Opsional)
        if (class_exists(\App\Models\Produk::class)) {
             \App\Models\Produk::create([
                // Pastikan kolom ini sesuai dengan migrasi tabel 'produks' kamu
                // Jika sudah tidak pakai id_kategori, hapus baris ini
                'id_kategori' => 5, 
                'nama_produk' => 'Biaya Jasa Pasang / Servis',
                'stok' => 999,
                'harga' => 14000,
                'gambar' => 'jasa.png'
             ]);
        }
    }
}