<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingServis;

class BookingServisController extends Controller
{
    // 1. Tampilkan Form Booking (User)
    public function create()
    {
        return view('service_form'); // Pastikan nama file view ini benar
    }

    // 2. Simpan Booking Baru (User)
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'nopol' => 'required',
            'tipe_motor' => 'required',
            'tgl_servis' => 'required|date',
            'jam' => 'required',
            'menit' => 'required',
        ]);

        BookingServis::create([
            'nama_pelanggan' => $request->nama,
            'no_hp' => $request->no_hp,
            'nopol' => $request->nopol,
            'tipe_motor' => $request->tipe_motor,
            'tgl_servis' => $request->tgl_servis,
            'jam_servis' => $request->jam . ':' . $request->menit,
            'keluhan' => $request->keluhan,
            'status' => 'Menunggu'
        ]);

        return redirect()->route('service.riwayat')->with('success', 'Booking berhasil dikirim! Menunggu konfirmasi Admin.');
    }

    // 3. Tampilkan Riwayat (Admin & User)
    public function index()
    {
        // Urutkan: Menunggu paling atas, lalu Tanggal terbaru
        $bookings = BookingServis::orderByRaw("FIELD(status, 'Menunggu', 'Proses', 'Selesai', 'Ditolak')")
                    ->orderBy('tgl_servis', 'desc')
                    ->get();
                    
        return view('service_riwayat', compact('bookings'));
    }
    
    // 4. TERIMA BOOKING (Admin) -> Ubah status jadi 'Proses'
    public function updateStatus($id)
    {
        $booking = BookingServis::findOrFail($id);
        $booking->status = 'Proses';
        $booking->save();

        return redirect()->route('service.riwayat')->with('success', 'Booking DITERIMA. Silakan tunggu pelanggan datang.');
    }

    // 5. TOLAK BOOKING (Admin) -> Ubah status jadi 'Ditolak'
    public function tolak($id)
    {
        $booking = BookingServis::findOrFail($id);
        $booking->status = 'Ditolak';
        $booking->save();

        return redirect()->route('service.riwayat')->with('error', 'Booking DITOLAK.');
    }

    // 6. HAPUS PERMANEN (Admin)
    public function destroy($id)
    {
        $booking = BookingServis::findOrFail($id);
        $booking->delete();

        return redirect()->route('service.riwayat')->with('success', 'Data booking dihapus permanen.');
    }
}