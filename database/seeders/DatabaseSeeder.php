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

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Panggil Seeder Barang (Pastikan file-file ini ada)
        $this->call([
            KategoriSeeder::class,
            ProdukSeeder::class, 
        ]);
        
        // 2. Cari data produk untuk transaksi dummy nanti
        // (Pastikan ProdukSeeder benar-benar mengisi data yang sesuai dengan pencarian ini)
        $produkOli = Oli::where('namaOli', 'LIKE', '%MOTUL%')->first();
        $produkBan = Ban::where('namaBan', 'LIKE', '%FDR%')->first();
        
        // 3. Buat User Biasa (Pelanggan)
        $user = User::firstOrCreate(['username' => 'estha'], [
            'name' => 'Estha Gusti',
            'email' => 'estha@gmail.com', // Tambahkan email biar lengkap (opsional)
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        // 4. Buat User Admin
        User::firstOrCreate(['username' => 'admin'], [
            'name' => 'Administrator',
            'email' => 'admin@axera.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // 5. Buat Profil Pelanggan untuk User 'estha'
        if (!Pelanggan::where('user_id', $user->id)->exists()) {
            Pelanggan::create([
                'user_id'        => $user->id,
                'nama_pelanggan' => 'Estha Gusti', // <-- WAJIB DIISI SEKARANG
                'no_hp'          => '081234567890',
                'alamat'         => 'Yogyakarta',
                'jenis_motor'    => 'Vario 150', 
                'no_polisi'      => 'AB 1234 XY'
            ]);
        }
        
        // 6. Buat Data Pelanggan Umum (Tanpa Akun) - Tes Hybrid
        Pelanggan::create([
            'user_id'        => null,
            'nama_pelanggan' => 'Budi Santoso (Umum)',
            'no_hp'          => '081999888777',
            'alamat'         => 'Sleman, Yogyakarta',
            'jenis_motor'    => 'Supra X 125', 
            'no_polisi'      => 'AB 5555 ZZ'
        ]);

        // 7. Buat Transaksi Dummy (Hanya jika produk ditemukan)
        if ($produkOli && $produkBan) {
            $transaksi = Transaksi::create([
                'user_id'           => $user->id,
                'tanggal_transaksi' => Carbon::now(),
                'total_harga'       => 274000, // (62k + 212k)
                'biaya_admin'       => 0, 
                'metode_pembayaran' => 'Cash',
                'status_pembayaran' => 'lunas', 
            ]);

            // Item 1: Oli
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_produk'    => $produkOli->idOli, 
                'jenis_produk' => 'oli',
                'jumlah'       => 1,
                'harga_saat_transaksi' => 62000, 
                'subtotal'     => 62000
            ]);

            // Item 2: Ban
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_produk'    => $produkBan->idBan,
                'jenis_produk' => 'ban',
                'jumlah'       => 1,
                'harga_saat_transaksi' => 212000, 
                'subtotal'     => 212000
            ]);
        }
    }
}