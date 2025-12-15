<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:50',
            'keterangan' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string|max:100',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil ditambahkan!');
    }

    // Tampilkan form edit kategori
    public function edit($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        return view('kategori.edit', compact('kategori'));
    }

    // Update data kategori
    public function update(Request $request, $id_kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:50',
            'keterangan' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string|max:100',
        ]);

        $kategori = Kategori::findOrFail($id_kategori);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil diperbarui!');
    }

    // Hapus data kategori
    public function destroy($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil dihapus!');
    }
}
