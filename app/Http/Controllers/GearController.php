<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gear; // Panggil model Gear
use Illuminate\Support\Facades\File;

class GearController extends Controller
{
    // Menampilkan halaman Gear
    public function index()
    {
        $gears = Gear::all(); // Ambil semua data dari tabel gear
        return view('gear', compact('gears'));
    }

    // Menyimpan data Gear baru
    public function store(Request $request)
    {
        $request->validate([
            'namaGear' => 'required|string|max:100',
            'stok'     => 'required|integer',
            'harga'    => 'required|numeric',
            'gambar'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['namaGear', 'stok', 'harga']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $data['gambar'] = $filename;
        }

        Gear::create($data); // Simpan ke tabel 'gear'

        return redirect()->route('gear')->with('success', 'Gear berhasil ditambahkan!');
    }
}