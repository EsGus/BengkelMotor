<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    // 1. Menampilkan Daftar Motor (Halaman Utama Data Motor)
    public function index()
    {
        // Ambil semua data motor, urutkan dari yang terbaru biar rapi
        $motors = Motor::orderBy('created_at', 'desc')->get();
        
        // Kirim data ke view 'motor.blade.php'
        return view('motor', compact('motors')); 
    }

    // 2. Menampilkan Form Tambah Motor
    public function create()
    {
        // Arahkan ke file resources/views/motor_tambah.blade.php
        return view('motor_tambah'); 
    }

    // 3. Proses Simpan Data Motor Baru ke Database
    public function store(Request $request)
    {
        // Validasi input agar tidak kosong & sesuai format
        $request->validate([
            'nama_motor' => 'required|string|max:100',
            'tipe_motor' => 'required|string|max:50',
        ]);

        // Simpan data
        Motor::create($request->all());

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('motor.index')->with('success', 'Data Motor Berhasil Ditambah');
    }

    // 4. Menampilkan Form Edit Motor
    public function edit($id)
    {
        // Cari data motor berdasarkan ID, jika tidak ada tampilkan error 404
        $motor = Motor::findOrFail($id);
        
        // Kirim data ke view 'motor_edit.blade.php'
        return view('motor_edit', compact('motor')); 
    }

    // 5. Proses Update Data Motor di Database
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_motor' => 'required|string|max:100',
            'tipe_motor' => 'required|string|max:50',
        ]);

        // Cari data dan update
        $motor = Motor::findOrFail($id);
        $motor->update($request->all());

        return redirect()->route('motor.index')->with('success', 'Data Motor Berhasil Diupdate');
    }

    // 6. Proses Hapus Data Motor
    public function destroy($id)
    {
        $motor = Motor::findOrFail($id);
        $motor->delete();

        return redirect()->route('motor.index')->with('success', 'Data Motor Dihapus');
    }
}