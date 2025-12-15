<?php

namespace App\Http\Controllers;
  
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{ 

    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaPelanggan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'noTelp' => 'required|string|max:20',
        ]);

        Pelanggan::create($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaPelanggan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'noTelp' => 'required|string|max:20',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus');
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.show', compact('pelanggan'));
    }
}
