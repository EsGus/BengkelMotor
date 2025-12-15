<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import Model
use App\Models\Oli;
use App\Models\Ban;
use App\Models\Gear;
use App\Models\Sparepart;

class ProdukController extends Controller
{
    // ================== CREATE (FORM TAMBAH) ==================
    public function create()
    {
        return view('produk_tambah'); 
    }

    // ================== STORE (SIMPAN DATA BARU) ==================
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'kategori'    => 'required|in:oli,ban,gear,sparepart',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Upload Gambar
        $filename = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Simpan ke folder public/img
            $file->move(public_path('img'), $filename);
        }

        $kategori = $request->kategori;

        // Simpan Data Sesuai Kategori
        if ($kategori == 'oli') {
            // Asumsi id_kategori oli = 1
            Oli::create(['namaOli' => $request->nama_produk, 'harga' => $request->harga, 'stok' => $request->stok, 'gambar' => $filename]); // Oli biasanya tidak punya kolom id_kategori di migrasi baru, tapi jika ada error serupa, tambahkan 'id_kategori' => 1
            return redirect()->route('oli')->with('success', 'Produk Oli Berhasil Ditambahkan');

        } elseif ($kategori == 'ban') {
            // Asumsi id_kategori ban = 2
            Ban::create(['namaBan' => $request->nama_produk, 'harga' => $request->harga, 'stok' => $request->stok, 'gambar' => $filename]); 
            return redirect()->route('ban')->with('success', 'Produk Ban Berhasil Ditambahkan');

        } elseif ($kategori == 'gear') {
            // Asumsi id_kategori gear = 3
            Gear::create(['namaGear' => $request->nama_produk, 'harga' => $request->harga, 'stok' => $request->stok, 'gambar' => $filename]);
            return redirect()->route('gear')->with('success', 'Produk Gear Berhasil Ditambahkan');

        } elseif ($kategori == 'sparepart') {
            // 🔥 PERBAIKAN DISINI: Menambahkan 'id_kategori' => 4 secara manual
            Sparepart::create([
                'namaSparepart' => $request->nama_produk, 
                'harga'         => $request->harga, 
                'stok'          => $request->stok, 
                'gambar'        => $filename,
                'id_kategori'   => 1 // <--- INI SOLUSINYA (Nilai dummy agar database tidak menolak)
            ]);
            return redirect()->route('sparepart.index')->with('success', 'Sparepart Berhasil Ditambahkan');
        }

        return redirect()->back()->with('error', 'Kategori tidak valid');
    }

    // ================== EDIT (FORM EDIT) ==================
    public function edit($kategori, $id)
    {
        $produk = null;
        $nama_produk = '';

        if ($kategori == 'oli') {
            $produk = Oli::findOrFail($id);
            $nama_produk = $produk->namaOli;
        } elseif ($kategori == 'ban') {
            $produk = Ban::findOrFail($id);
            $nama_produk = $produk->namaBan;
        } elseif ($kategori == 'gear') {
            $produk = Gear::findOrFail($id);
            $nama_produk = $produk->namaGear;
        } elseif ($kategori == 'sparepart') {
            $produk = Sparepart::findOrFail($id);
            $nama_produk = $produk->namaSparepart;
        } else {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan');
        }

        return view('produk_edit', compact('produk', 'kategori', 'nama_produk'));
    }

    // ================== UPDATE (SIMPAN PERUBAHAN) ==================
    public function update(Request $request, $kategori, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $model = null;
        if ($kategori == 'oli') $model = Oli::findOrFail($id);
        elseif ($kategori == 'ban') $model = Ban::findOrFail($id);
        elseif ($kategori == 'gear') $model = Gear::findOrFail($id);
        elseif ($kategori == 'sparepart') $model = Sparepart::findOrFail($id);

        $dataUpdate = [
            'harga' => $request->harga,
            'stok'  => $request->stok,
        ];

        // Mapping Nama Kolom
        if ($kategori == 'oli') $dataUpdate['namaOli'] = $request->nama_produk;
        elseif ($kategori == 'ban') $dataUpdate['namaBan'] = $request->nama_produk;
        elseif ($kategori == 'gear') $dataUpdate['namaGear'] = $request->nama_produk;
        elseif ($kategori == 'sparepart') $dataUpdate['namaSparepart'] = $request->nama_produk;

        // Update Gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama pakai fungsi PHP native (lebih aman dari error class not found)
            if ($model->gambar && file_exists(public_path('img/' . $model->gambar))) {
                unlink(public_path('img/' . $model->gambar));
            }

            // Simpan gambar baru
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $dataUpdate['gambar'] = $filename;
        }

        $model->update($dataUpdate);

        // Redirect yang Konsisten
        $routeRedirect = $kategori;
        if ($kategori == 'sparepart') {
            $routeRedirect = 'sparepart.index';
        }

        return redirect()->route($routeRedirect)->with('success', 'Produk berhasil diperbarui!');
    }

    // ================== DESTROY (HAPUS DATA) ==================
    public function destroy($kategori, $id)
    {
        $model = null;
        if ($kategori == 'oli') $model = Oli::findOrFail($id);
        elseif ($kategori == 'ban') $model = Ban::findOrFail($id);
        elseif ($kategori == 'gear') $model = Gear::findOrFail($id);
        elseif ($kategori == 'sparepart') $model = Sparepart::findOrFail($id);

        // Hapus file gambar
        if ($model->gambar && file_exists(public_path('img/' . $model->gambar))) {
            unlink(public_path('img/' . $model->gambar));
        }

        $model->delete();

        // Redirect yang Konsisten
        $routeRedirect = $kategori;
        if ($kategori == 'sparepart') {
            $routeRedirect = 'sparepart.index';
        }

        return redirect()->route($routeRedirect)->with('success', 'Produk berhasil dihapus!');
    }
}