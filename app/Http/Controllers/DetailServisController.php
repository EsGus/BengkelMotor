<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailServis;

class DetailServisController extends Controller
{
    // Menampilkan semua data detail servis
    public function index()
    {
        $data = DetailServis::all();
        return response()->json($data); // atau bisa return ke view
    }

    // Menampilkan detail berdasarkan ID transaksi
    public function show($id)
    {
        $detail = DetailServis::find($id);

        if (!$detail) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($detail);
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'idServis' => 'required|integer',
            'hargaTransaksiServis' => 'required|numeric',
            'jumlahJualSparepart' => 'required|integer',
            'tanggalTransaksi' => 'required|date',
        ]);

        $detail = DetailServis::create([
            'idServis' => $request->idServis,
            'hargaTransaksiServis' => $request->hargaTransaksiServis,
            'jumlahJualSparepart' => $request->jumlahJualSparepart,
            'tanggalTransaksi' => $request->tanggalTransaksi,
        ]);

        return response()->json(['message' => 'Data berhasil disimpan', 'data' => $detail]);
    }

    // Mengupdate data
    public function update(Request $request, $id)
    {
        $detail = DetailServis::find($id);

        if (!$detail) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'idServis' => 'integer',
            'hargaTransaksiServis' => 'numeric',
            'jumlahJualSparepart' => 'integer',
            'tanggalTransaksi' => 'date',
        ]);

        $detail->update($request->all());

        return response()->json(['message' => 'Data berhasil diperbarui', 'data' => $detail]);
    }

    // Menghapus data
    public function destroy($id)
    {
        $detail = DetailServis::find($id);

        if (!$detail) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $detail->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
