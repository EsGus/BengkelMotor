<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarLayanan;

class DaftarLayananController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $layanans = DaftarLayanan::all();
        return view('daftar_layanan.index', compact('layanans'));
    }

    // Tampilkan form tambah data
    public function create()
    {
        return view('daftar_layanan.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_handphone' => 'required',
            'nomor_polisi' => 'required',
            'tipe_motor' => 'required',
            'tgl_rencana_servis' => 'required|date',
            'rencana_jam' => 'required',
            'keluhan' => 'nullable|string'
        ]);

        DaftarLayanan::create($request->all());

        return redirect()->route('daftar-layanan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // Hapus data
    public function destroy($id)
    {
        $layanan = DaftarLayanan::findOrFail($id);
        $layanan->delete();

        return redirect()->route('daftar-layanan.index')->with('success', 'Data berhasil dihapus!');
    }
}
