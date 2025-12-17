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
use App\Models\Montir;
use App\Models\Motor;
use App\Models\Servis;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Panggil Seeder Barang
        $this->call([
            KategoriSeeder::class,
            ProdukSeeder::class, 
        ]);
        
        // 2. Buat Data Montir (Disimpan ke variabel $montir1 agar bisa dipakai di bawah)
        $montir1 = Montir::create(['nama' => 'Pak Slamet', 'keahlian' => 'Kepala Mekanik', 'no_hp' => '081222333444']);
        Montir::create(['nama' => 'Mas Joko', 'keahlian' => 'Spesialis Matic', 'no_hp' => '081555666777']);
        
        // 3. Buat Data Motor (Disimpan ke variabel $motor1)
        $motor1 = Motor::create(['nama_motor' => 'Honda Beat', 'tipe_motor' => 'Matic']);
        Motor::create(['nama_motor' => 'Yamaha NMAX', 'tipe_motor' => 'Matic']);

        // 4. Cari data produk
        $produkOli = Oli::where('namaOli', 'LIKE', '%MOTUL%')->first();
        $produkBan = Ban::where('namaBan', 'LIKE', '%FDR%')->first();
        
        // 5. Buat User Biasa
        $user = User::firstOrCreate(['username' => 'estha'], [
            'name' => 'Estha Gusti',
            'email' => 'estha@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        // 6. Buat User Admin
        User::firstOrCreate(['username' => 'admin'], [
            'name' => 'Administrator',
            'email' => 'admin@axera.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // 7. Buat Profil Pelanggan
        if (!Pelanggan::where('user_id', $user->id)->exists()) {
            Pelanggan::create([
                'user_id'        => $user->id,
                'nama_pelanggan' => 'Estha Gusti',
                'no_hp'          => '081234567890',
                'alamat'         => 'Yogyakarta',
                'jenis_motor'    => 'Vario 150', 
                'no_polisi'      => 'AB 1234 XY'
            ]);
        }
        
        // 8. Pelanggan Umum
        Pelanggan::create([
            'user_id'        => null,
            'nama_pelanggan' => 'Budi Santoso (Umum)',
            'no_hp'          => '081999888777',
            'alamat'         => 'Sleman, Yogyakarta',
            'jenis_motor'    => 'Supra X 125', 
            'no_polisi'      => 'AB 5555 ZZ'
        ]);

        // 9. Transaksi Dummy (Toko Online) -> Rp 274.000
        if ($produkOli && $produkBan) {
            $transaksi = Transaksi::create([
                'user_id'           => $user->id,
                'tanggal_transaksi' => Carbon::now(),
                'total_harga'       => 274000,
                'biaya_admin'       => 0, 
                'metode_pembayaran' => 'Cash',
                'status_pembayaran' => 'lunas', 
            ]);

            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_produk'    => $produkOli->idOli, 
                'jenis_produk' => 'oli',
                'jumlah'       => 1,
                'harga_saat_transaksi' => 62000, 
                'subtotal'     => 62000
            ]);

            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_produk'    => $produkBan->idBan, 
                'jenis_produk' => 'ban',
                'jumlah'       => 1,
                'harga_saat_transaksi' => 212000, 
                'subtotal'     => 212000
            ]);
        }

        // 10. SERVIS DUMMY (Bengkel Fisik) -> Rp 150.000
        Servis::create([
            'nama_pelanggan' => 'Budi Santoso (Umum)',
            'no_hp'          => '081999888777',
            'idMotor'        => $motor1->id,  // Menggunakan ID Honda Beat yg dibuat di atas
            'idMontir'       => $montir1->id, // Menggunakan ID Pak Slamet yg dibuat di atas
            'idSparepart'    => null, 
            'tanggalServis'  => Carbon::now(),
            'totalHarga'     => 150000, 
            'jumlahSparepart'=> 0,
            'keluhan'        => 'Ganti Oli & Servis Ringan'
        ]);
    }
}