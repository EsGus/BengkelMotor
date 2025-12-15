<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;
use Illuminate\Support\Facades\File; // Ganti Storage dengan File untuk manipulasi folder public

class SparepartController extends Controller
{
    public function index()
    {
        $spareparts = Sparepart::all();
        return view('sparepart', compact('spareparts'));
    }

    public function show($id)
    {
        return redirect()->route('sparepart.index');
    }

    public function edit($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        return view('sparepart_edit', compact('sparepart'));
    }

    // 🟦 SIMPAN DATA BARU
    public function store(Request $request)
    {
        $request->validate([
            'namaSparepart' => 'required|string|max:100',
            'stok'          => 'required|integer',
            'harga'         => 'required|numeric',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['namaSparepart', 'stok', 'harga']);

        // LOGIKA BARU UNTUK GAMBAR
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Buat nama unik: waktu_namaasli.jpg (misal: 171999_ban.jpg)
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Pindahkan file ke folder public/img
            $file->move(public_path('img'), $filename);
            
            // Simpan nama file saja ke database
            $data['gambar'] = $filename;
        }

        Sparepart::create($data);

        return redirect()->route('sparepart.index')->with('success', 'Data sparepart berhasil ditambahkan.');
    }

    // 🟫 UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'namaSparepart' => 'required|string|max:100',
            'stok'          => 'required|integer',
            'harga'         => 'required|numeric',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $sparepart = Sparepart::findOrFail($id);
        $data = $request->only(['namaSparepart', 'stok', 'harga']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Hapus gambar lama jika ada di folder public/img
            if ($sparepart->gambar && File::exists(public_path('img/' . $sparepart->gambar))) {
                File::delete(public_path('img/' . $sparepart->gambar));
            }

            // Upload gambar baru ke public/img
            $file->move(public_path('img'), $filename);
            $data['gambar'] = $filename;
        }

        $sparepart->update($data);

        return redirect()->route('sparepart.index')->with('success', 'Data sparepart berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sparepart = Sparepart::findOrFail($id);

        // Hapus gambar dari folder public/img
        if ($sparepart->gambar && File::exists(public_path('img/' . $sparepart->gambar))) {
            File::delete(public_path('img/' . $sparepart->gambar));
        }

        $sparepart->delete();

        return redirect()->route('sparepart.index')->with('success', 'Data sparepart berhasil dihapus.');
    }
}