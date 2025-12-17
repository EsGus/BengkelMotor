<?php

namespace App\Http\Controllers;

use App\Models\Servis;
use App\Models\Motor;
use App\Models\Montir;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // <--- WAJIB ADA: Untuk kirim request ke Fonnte

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

    // UPDATE PENTING DI SINI
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

        // 2. Logika Kurangi Stok Sparepart
        if ($request->idSparepart && $request->jumlahSparepart > 0) {
            $part = Sparepart::find($request->idSparepart);
            
            if ($part) {
                if ($part->stok < $request->jumlahSparepart) {
                    $servis->delete(); 
                    return back()->with('error', 'Stok sparepart tidak cukup!');
                }
                $part->stok = $part->stok - $request->jumlahSparepart;
                $part->save();
            }
        }

        // ==========================================
        // 3. LOGIKA KIRIM NOTA WA (FONNTE)
        // ==========================================
        
        // A. Format Nomor HP (08xx -> 628xx)
        $target = $request->no_hp;
        if (substr($target, 0, 1) == '0') {
            $target = '62' . substr($target, 1);
        }

        // B. Ambil Nama Motor (Manual query karena $request->idMotor cuma ID)
        $namaMotor = 'Motor Tidak Diketahui';
        $motorData = Motor::find($request->idMotor);
        if($motorData) {
            $namaMotor = $motorData->nama_motor . ' (' . $motorData->tipe_motor . ')';
        }

        // C. Susun Pesan
        $pesan = "*NOTA SERVIS - AXERA MOTOR*\n";
        $pesan .= "--------------------------------\n";
        $pesan .= "Halo, " . $request->nama_pelanggan . "!\n";
        $pesan .= "Terima kasih telah melakukan servis.\n\n";
        $pesan .= "🗓 Tgl: " . date('d-m-Y H:i') . "\n";
        $pesan .= "🏍 Motor: " . $namaMotor . "\n";
        $pesan .= "🔧 Keluhan: " . $request->keluhan . "\n";
        $pesan .= "--------------------------------\n";
        $pesan .= "💰 *TOTAL: Rp " . number_format($request->totalHarga, 0, ',', '.') . "*\n";
        $pesan .= "--------------------------------\n";
        $pesan .= "Simpan pesan ini sebagai bukti pembayaran.\n";
        $pesan .= "~ Axera Motor Official";

        // D. Kirim Request ke Fonnte
        try {
            Http::withHeaders([
                'Authorization' => 'xML4MqbSi4YYNUpUMjXG', // <--- GANTI TOKEN INI !!!
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $pesan,
            ]);
        } catch (\Exception $e) {
            // Jika error koneksi, biarkan saja agar aplikasi tidak crash
        }
        // ==========================================

        return redirect()->route('servis.index')->with('success', 'Servis dicatat & Nota WA Terkirim.');
    }

    public function destroy($id)
    {
        $servis = Servis::findOrFail($id);
        $servis->delete();
        return redirect()->route('servis.index')->with('success', 'Data servis dihapus.');
    }

    // FITUR CETAK NOTA (PDF/Print Biasa)
    public function cetakNota($id)
    {
        $servis = Servis::with(['motor', 'montir', 'sparepart'])->findOrFail($id);
        return view('servis_nota', compact('servis'));
    }
}