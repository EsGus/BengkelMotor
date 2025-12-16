<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::with('user')->get();
        // Mengarah langsung ke pelanggan.blade.php
        return view('pelanggan', compact('pelanggan'));
    }

    public function create()
    {
        // Mengarah ke pelanggan_tambah.blade.php
        return view('pelanggan_tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaPelanggan' => 'required|string', 
            'no_hp'         => 'required|string',
            'alamat'        => 'required|string',
            'jenis_motor'   => 'required|string',
            'no_polisi'     => 'required|string',
        ]);

        // Simpan data (user_id null karena input manual admin)
        Pelanggan::create([
            'user_id' => null, 
            'namaPelanggan' => $request->namaPelanggan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'jenis_motor' => $request->jenis_motor,
            'no_polisi' => $request->no_polisi,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        // Mengarah ke pelanggan_edit.blade.php
        return view('pelanggan_edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        
        $request->validate([
            'no_hp'       => 'required',
            'alamat'      => 'required',
            'jenis_motor' => 'required',
            'no_polisi'   => 'required',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan diupdate');
    }

    public function destroy($id)
    {
        Pelanggan::findOrFail($id)->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan dihapus');
    }
}