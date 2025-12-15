<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Panggil semua model produk karena kamu punya 4 tabel berbeda
use App\Models\Sparepart;
use App\Models\Oli;
use App\Models\Ban;
use App\Models\Gear;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function show()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // 🔥 INI METHOD YANG HILANG (Solusi Error BadMethodCallException) 🔥
    public function store(Request $request)
    {
        // 1. Validasi Input dari Form
        $request->validate([
            'id_produk'    => 'required',
            'qty'          => 'required|integer|min:1',
            // 'jenis_barang' => 'required', // Pastikan form mengirim jenis_barang (oli/ban/gear/sparepart)
        ]);

        $id = $request->id_produk;
        $qty = $request->qty;
        $jenis = $request->jenis_barang ?? 'sparepart'; // Default ke sparepart jika tidak ada

        // 2. Cari Produk Berdasarkan Jenisnya
        $product = null;
        $namaProduk = '';
        $hargaProduk = 0;
        $gambarProduk = '';

        if ($jenis == 'oli') {
            $product = Oli::find($id);
            if ($product) {
                $namaProduk = $product->namaOli;
                $hargaProduk = $product->harga;
                $gambarProduk = $product->gambar;
            }
        } elseif ($jenis == 'ban') {
            $product = Ban::find($id);
            if ($product) {
                $namaProduk = $product->namaBan;
                $hargaProduk = $product->harga;
                $gambarProduk = $product->gambar;
            }
        } elseif ($jenis == 'gear') {
            $product = Gear::find($id);
            if ($product) {
                $namaProduk = $product->namaGear;
                $hargaProduk = $product->harga;
                $gambarProduk = $product->gambar;
            }
        } else {
            // Default Sparepart
            $product = Sparepart::find($id);
            if ($product) {
                $namaProduk = $product->namaSparepart;
                $hargaProduk = $product->harga;
                $gambarProduk = $product->gambar;
            }
        }

        // Jika produk tidak ditemukan, kembalikan error
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }

        // 3. Masukkan ke Session Cart
        $cart = session()->get('cart', []);
        
        // Buat ID unik untuk keranjang (gabungan jenis + id) biar tidak bentrok
        $cartId = $jenis . '_' . $id;

        if (isset($cart[$cartId])) {
            $cart[$cartId]['qty'] += $qty;
        } else {
            $cart[$cartId] = [
                'id_asli' => $id,
                'jenis' => $jenis,
                'name' => $namaProduk,
                'price' => $hargaProduk,
                'qty' => $qty,
                'photo' => $gambarProduk
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.show')->with('success', 'Berhasil masuk keranjang!');
    }

    // ... method update dan remove biarkan seperti semula ...
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['qty'] = $request->qty;
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.show');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.show');
    }
    
    // Method clear (Opsional, untuk kosongkan keranjang)
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.show');
    }
}