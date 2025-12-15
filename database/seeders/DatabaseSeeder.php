<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Oli;
use App\Models\Ban;
use App\Models\Produk;

class DatabaseSeeder extends Seeder // <--- PASTIKAN NAMANYA INI
{
    public function run(): void
    {
        // 1. Panggil Seeder Barang
        $this->call([
            KategoriSeeder::class,
            ProdukSeeder::class, // Ini akan menjalankan file ProdukSeeder.php di atas
        ]);
        
        // 2. Cari data untuk transaksi dummy
        $produkOli = Oli::where('namaOli', 'LIKE', '%MOTUL%')->first();
        $produkBan = Ban::where('namaBan', 'LIKE', '%FDR%')->first();
        
        $produkJasa = null;
        if (class_exists(\App\Models\Produk::class)) {
             $produkJasa = Produk::where('nama_produk', 'LIKE', '%Jasa%')->first();
        }

        // 3. Buat User Admin & User Biasa
        User::firstOrCreate(['username' => 'estha'], [
            'name' => 'Estha Gusti',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        User::firstOrCreate(['username' => 'admin'], [
            'name' => 'Administrator',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        $user = User::where('username', 'estha')->first();

        // 4. Buat Profil Pelanggan
        if (!Pelanggan::where('user_id', $user->id)->exists()) {
            Pelanggan::create([
                'user_id' => $user->id,
                'no_hp' => '081234567890',
                'alamat' => 'Yogyakarta',
                'jenis_motor' => 'Vario 150', 
                'no_polisi' => 'AB 1234 XY'
            ]);
        }

        // 5. Buat Transaksi Dummy (Jika produk ditemukan)
        if ($produkOli && $produkBan) {
            $transaksi = Transaksi::create([
                'user_id' => $user->id,
                'tanggal_transaksi' => Carbon::now(),
                'total_harga' => 289000, 
                'biaya_admin' => 1000, 
                'metode_pembayaran' => 'BCA Virtual Account',
                'status_pembayaran' => 'lunas', 
            ]);

            // Item 1: Oli
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_produk' => $produkOli->idOli, 
                'jenis_produk' => 'oli',
                'jumlah' => 1,
                'harga_saat_transaksi' => 62000, // <--- GANTI INI
                'subtotal' => 62000
            ]);

            // Item 2: Ban
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_produk' => $produkBan->idBan,
                'jenis_produk' => 'ban',
                'jumlah' => 1,
                'harga_saat_transaksi' => 212000, // <--- GANTI INI
                'subtotal' => 212000
            ]);
        }
    }
}