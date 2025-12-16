<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Servis;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Default tanggal bulan ini jika tidak difilter
        $startDate = $request->start_date ?? Carbon::now()->startOfMonth();
        $endDate = $request->end_date ?? Carbon::now()->endOfMonth();

        // 1. Ambil Penjualan Online (Sparepart/Oli/dll)
        $penjualan = Transaksi::whereBetween('tanggal_transaksi', [$startDate, $endDate])
            ->where('status_pembayaran', 'lunas')
            ->get();

        // 2. Ambil Pendapatan Servis Bengkel
        $servis = Servis::whereBetween('tanggalServis', [$startDate, $endDate])->get();

        // 3. Hitung Total
        $totalPenjualan = $penjualan->sum('total_harga');
        $totalServis = $servis->sum('totalHarga');
        $grandTotal = $totalPenjualan + $totalServis;

        // Mengarah ke resources/views/laporan.blade.php
        return view('laporan', compact(
            'penjualan', 
            'servis', 
            'totalPenjualan', 
            'totalServis', 
            'grandTotal', 
            'startDate', 
            'endDate'
        ));
    }
}