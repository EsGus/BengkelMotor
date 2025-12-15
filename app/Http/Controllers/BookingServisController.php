<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingServis;

class BookingServisController extends Controller
{
    // 1. Tampilkan Form
    public function create()
    {
        return view('service_form');
    }

    // 2. Simpan Data dari Form
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
            'jam_servis' => $request->jam . ':' . $request->menit, // Gabung jam & menit
            'keluhan' => $request->keluhan
        ]);

        return redirect()->route('service.riwayat')->with('success', 'Booking berhasil dikirim!');
    }

    // 3. Tampilkan Riwayat (Daftar semua booking)
    public function index()
    {
        // Ambil data terbaru paling atas
        $bookings = BookingServis::orderBy('created_at', 'desc')->get();
        return view('service_riwayat', compact('bookings'));
    }
    
    // 4. Update Status (Misal Admin klik "Selesai")
    public function updateStatus($id)
    {
        $booking = BookingServis::find($id);
        $booking->status = 'Selesai';
        $booking->save();
        return back()->with('success', 'Status diperbarui!');
    }
}