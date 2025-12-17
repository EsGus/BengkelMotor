<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaksi; 
use App\Models\Servis;    

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Tanggal
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate   = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // 2. Query Toko Online
        $transaksi = Transaksi::whereDate('tanggal_transaksi', '>=', $startDate)
                              ->whereDate('tanggal_transaksi', '<=', $endDate)
                              ->where('status_pembayaran', 'lunas') 
                              ->with('user')
                              ->get();

        // 3. Query Servis
        $servis = Servis::whereDate('tanggalServis', '>=', $startDate)
                        ->whereDate('tanggalServis', '<=', $endDate)
                        ->get();

        // 4. Hitung Total
        $pendapatanToko   = $transaksi->sum('total_harga');
        $pendapatanServis = $servis->sum('totalHarga');
        $grandTotal       = $pendapatanToko + $pendapatanServis;

        // 5. Gabung Data
        $dataLaporan = collect();

        foreach($transaksi as $t) {
            $dataLaporan->push([
                'tanggal'    => $t->tanggal_transaksi,
                'sumber'     => 'Toko Online',
                'keterangan' => 'Inv #' . $t->id . ' - ' . ($t->user->username ?? 'User Terhapus'),
                'nominal'    => $t->total_harga
            ]);
        }

        foreach($servis as $s) {
            $dataLaporan->push([
                'tanggal'    => $s->tanggalServis,
                'sumber'     => 'Bengkel Servis',
                'keterangan' => 'Servis #' . $s->id . ' - ' . $s->nama_pelanggan,
                'nominal'    => $s->totalHarga
            ]);
        }

        $dataLaporan = $dataLaporan->sortByDesc('tanggal');

        // 6. Kirim ke View 'laporan' (Sesuai nama file Anda)
        return view('laporan', compact(  // <--- PERUBAHAN DI SINI
            'startDate', 
            'endDate', 
            'pendapatanToko', 
            'pendapatanServis', 
            'grandTotal', 
            'dataLaporan'
        ));
    }
}