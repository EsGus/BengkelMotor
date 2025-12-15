<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    /** 
     * Menampilkan semua transaksi
     */
    public function index()
    {
        $transaksi = Transaksi::orderBy('id', 'DESC')->get();
        return response()->json($transaksi);
    }

    /**
     * Menyimpan data transaksi
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'            => 'required|integer',
            'tanggal_transaksi'  => 'required|date',
            'total_harga'        => 'required|numeric',
            'biaya_admin'        => 'required|numeric',
            'metode_pembayaran'  => 'required|string',
        ]);

        $transaksi = Transaksi::create([
            'user_id'            => $request->user_id,
            'tanggal_transaksi'  => $request->tanggal_transaksi,
            'total_harga'        => $request->total_harga,
            'biaya_admin'        => $request->biaya_admin,
            'metode_pembayaran'  => $request->metode_pembayaran,
            'status_pembayaran'  => 'pending',
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil dibuat',
            'data'    => $transaksi
        ]);
    }

    /**
     * Menampilkan detail transaksi
     */
    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return response()->json($transaksi);
    }

    /**
     * Update transaksi
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update($request->all());

        return response()->json([
            'message' => 'Transaksi berhasil diupdate',
            'data' => $transaksi
        ]);
    }

    /**
     * Mengubah status pembayaran (pending → lunas)
     */
    public function updateStatus($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->status_pembayaran = 'lunas';
        $transaksi->save();

        return response()->json([
            'message' => 'Status pembayaran diperbarui menjadi LUNAS',
            'data'    => $transaksi
        ]);
    }

    /**
     * Menghapus transaksi
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return response()->json(['message' => 'Transaksi berhasil dihapus']);
    }
}