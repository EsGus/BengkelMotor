<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\File;

class PegawaiController extends Controller
{
    // READ
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('pegawai', compact('pegawai'));
    }

    // CREATE (FORM)
    public function create()
    {
        return view('tambah-pegawai');
    }

    // STORE (SIMPAN DATA BARU) - FOTO OPSIONAL
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'email' => 'required|email|unique:pegawais,email',
            // Ubah 'required' menjadi 'nullable' agar foto tidak wajib
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' 
        ]);

        // 2. Set Default Foto (Jika user tidak upload foto)
        // Pastikan Anda punya file 'no-image.jpg' di folder public/img, atau kosongkan string ini
        $pathFoto = 'img/no-image.jpg'; 

        // 3. Cek jika ada file yang diupload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            
            $file->move(public_path('img'), $namaFile);
            $pathFoto = 'img/' . $namaFile;
        }

        // 4. Simpan ke Database
        Pegawai::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'foto' => $pathFoto
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai baru berhasil ditambahkan!');
    }

    // EDIT (FORM)
    public function edit($id)
    {
        $data = Pegawai::findOrFail($id);
        return view('edit-pegawai', compact('data'));
    }

    // UPDATE (SIMPAN PERUBAHAN)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'email' => 'required|email',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $pegawai = Pegawai::findOrFail($id);

        $dataUpdate = [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
        ];

        if ($request->hasFile('foto')) {
            if ($pegawai->foto && File::exists(public_path($pegawai->foto)) && $pegawai->foto != 'img/no-image.jpg') {
                File::delete(public_path($pegawai->foto));
            }

            $file = $request->file('foto');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('img'), $namaFile);
            
            $dataUpdate['foto'] = 'img/' . $namaFile;
        }

        $pegawai->update($dataUpdate);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui!');
    }

    // DESTROY (HAPUS)
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        // Jangan hapus file default jika dipakai
        if ($pegawai->foto && File::exists(public_path($pegawai->foto)) && $pegawai->foto != 'img/no-image.jpg') {
            File::delete(public_path($pegawai->foto));
        }

        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus permanen.');
    }
}