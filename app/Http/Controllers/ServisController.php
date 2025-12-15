<?php

namespace App\Http\Controllers;

use App\Models\Servis;
use App\Models\Motor;
use App\Models\Montir;
use App\Models\Sparepart;
use Illuminate\Http\Request;

class ServisController extends Controller
{
    public function index()
    {
        $servis = Servis::with(['motor', 'montir', 'sparepart'])->get();
        return view('servis.index', compact('servis'));
    }

    public function create()
    {
        $motor = Motor::all(); 
        $montir = Montir::all();
        $sparepart = Sparepart::all();
        return view('servis.create', compact('motor', 'montir', 'sparepart'));
    }

    // Menyimpan data servis baru
    public function store(Request $request)
    {
        $request->validate([
            'idMotor' => 'required',
            'idMontir' => 'required',
            'idSparepart' => 'required',
            'tanggalServis' => 'required|date',
            'totalHarga' => 'required|numeric',
            'jumlahSparepart' => 'required|integer',
            'keluhan' => 'required|string',
        ]);

        Servis::create($request->all());
        return redirect()->route('servis.index')->with('success', 'Data servis berhasil ditambahkan.');
    }

    // Menampilkan form edit data servis
    public function edit($id)
    {
        $servis = Servis::findOrFail($id);
        $motor = Motor::all();
        $montir = Montir::all();
        $sparepart = Sparepart::all();
        return view('servis.edit', compact('servis', 'motor', 'montir', 'sparepart'));
    }

    // Mengupdate data servis
    public function update(Request $request, $id)
    {
        $request->validate([
            'idMotor' => 'required',
            'idMontir' => 'required',
            'idSparepart' => 'required',
            'tanggalServis' => 'required|date',
            'totalHarga' => 'required|numeric',
            'jumlahSparepart' => 'required|integer',
            'keluhan' => 'required|string',
        ]);

        $servis = Servis::findOrFail($id);
        $servis->update($request->all());

        return redirect()->route('servis.index')->with('success', 'Data servis berhasil diperbarui.');
    }

    // Menghapus data servis
    public function destroy($id)
    {
        $servis = Servis::findOrFail($id);
        $servis->delete();

        return redirect()->route('servis.index')->with('success', 'Data servis berhasil dihapus.');
    }
}
