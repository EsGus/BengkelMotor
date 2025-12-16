<?php

namespace App\Http\Controllers;

use App\Models\Servis;
use App\Models\Motor;
use App\Models\Montir;
use App\Models\Sparepart;
use Illuminate\Http\Request;

class ServisController extends Controller
{
    // Menampilkan Riwayat Servis (ADMIN)
    public function index()
    {
        $servis = Servis::with(['motor', 'montir', 'sparepart'])->orderBy('tanggalServis', 'desc')->get();
        return view('servis', compact('servis'));
    }

    public function create()
    {
        $motor = Motor::all(); 
        $montir = Montir::all();
        $sparepart = Sparepart::all();
        return view('servis_tambah', compact('motor', 'montir', 'sparepart'));
    }

    // UPDATE PENTING DI SINI (SUDAH DIPERBAIKI)
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string',
            'no_hp'          => 'required|string',
            'idMotor'        => 'required',
            'idMontir'       => 'required',
            'idSparepart'    => 'nullable',        
            'tanggalServis'  => 'required|date',
            'totalHarga'     => 'required|numeric',
            'keluhan'        => 'required|string',
        ]);

        // 1. Simpan Data Servis
        $servis = Servis::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp'          => $request->no_hp,
            'idMotor'        => $request->idMotor,
            'idMontir'       => $request->idMontir,
            'idSparepart'    => $request->idSparepart,
            'tanggalServis'  => $request->tanggalServis,
            'totalHarga'     => $request->totalHarga,
            'jumlahSparepart'=> $request->jumlahSparepart ?? 0,
            'keluhan'        => $request->keluhan
        ]);

        // 2. Logika Kurangi Stok Sparepart (Jika ada sparepart yg dipilih)
        if ($request->idSparepart && $request->jumlahSparepart > 0) {
            $part = Sparepart::find($request->idSparepart);
            
            if ($part) {
                // Cek apakah stok cukup?
                if ($part->stok < $request->jumlahSparepart) {
                    // Batalkan servis jika stok kurang (Opsional, hapus data servis yg baru dibuat)
                    $servis->delete(); 
                    return back()->with('error', 'Stok sparepart tidak cukup!');
                }

                // Kurangi stok
                $part->stok = $part->stok - $request->jumlahSparepart;
                $part->save();
            }
        }

        return redirect()->route('servis.index')->with('success', 'Servis dicatat & Stok sparepart berkurang.');
    }

    public function destroy($id)
    {
        $servis = Servis::findOrFail($id);
        $servis->delete();
        return redirect()->route('servis.index')->with('success', 'Data servis dihapus.');
    }

    // FITUR CETAK NOTA
    public function cetakNota($id)
    {
        $servis = Servis::with(['motor', 'montir', 'sparepart'])->findOrFail($id);
        return view('servis_nota', compact('servis'));
    }
}