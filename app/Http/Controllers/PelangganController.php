<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // 1. Tampilkan Daftar
    public function index()
    {
        $pelanggans = Pelanggan::with('user')->orderBy('created_at', 'desc')->get();
        return view('pelanggan', compact('pelanggans'));
    }

    // 2. Form Tambah
    public function create()
    {
        // Ambil data user untuk dropdown (opsional dipilih nanti)
        $users = User::where('role', 'user')->get();
        return view('pelanggan_tambah', compact('users'));
    }

    // 3. Simpan Data (LOGIKA HYBRID)
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'user_id'       => 'nullable|exists:users,id',
            'namaPelanggan' => 'required_without:user_id', // Wajib isi jika user_id kosong
            'no_hp'         => 'required',
            'alamat'        => 'required',
            'jenis_motor'   => 'required',
            'no_polisi'     => 'required',
        ]);

        // Logika Nama: Jika pilih User, ambil namanya. Jika tidak, pakai input manual.
        $nama = $request->namaPelanggan;
        
        if($request->user_id) {
            $user = User::find($request->user_id);
            $nama = $user->username; // Atau $user->name
        }

        Pelanggan::create([
            'user_id'        => $request->user_id,
            'nama_pelanggan' => $nama, // <-- SUDAH DIPERBAIKI (Sesuai kolom DB)
            'no_hp'          => $request->no_hp,
            'alamat'         => $request->alamat,
            'jenis_motor'    => $request->jenis_motor,
            'no_polisi'      => $request->no_polisi,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan Berhasil Ditambah');
    }

    // 4. Form Edit
    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan_edit', compact('pelanggan'));
    }

    // 5. Update Data
    public function update(Request $request, $id)
    {
        $request->validate([
            // Kita validasi 'namaPelanggan' (dari form) atau 'nama_pelanggan' (jika view sudah diubah)
            // Disini diasumsikan input form bernama 'namaPelanggan' atau 'nama_pelanggan'
            'no_hp'       => 'required',
            'alamat'      => 'required',
            'jenis_motor' => 'required',
            'no_polisi'   => 'required',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        
        // KITA UPDATE MANUAL AGAR MAPPINGNYA BENAR
        // Karena input form mungkin 'namaPelanggan', tapi DB butuh 'nama_pelanggan'
        
        $dataUpdate = [
            'no_hp'       => $request->no_hp,
            'alamat'      => $request->alamat,
            'jenis_motor' => $request->jenis_motor,
            'no_polisi'   => $request->no_polisi,
        ];

        // Jika ada input nama manual yang dikirim (saat edit)
        if($request->has('namaPelanggan')){
             $dataUpdate['nama_pelanggan'] = $request->namaPelanggan;
        } 
        // Atau jika form edit menggunakan name="nama_pelanggan"
        elseif($request->has('nama_pelanggan')){
             $dataUpdate['nama_pelanggan'] = $request->nama_pelanggan;
        }

        $pelanggan->update($dataUpdate);

        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan Diupdate');
    }

    // 6. Hapus Data
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan Dihapus');
    }
}