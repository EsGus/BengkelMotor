<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Jangan lupa import Carbon

// Import Model
use App\Models\Cart;
use App\Models\Oli;
use App\Models\Ban;
use App\Models\Gear;
use App\Models\Sparepart;
use App\Models\Transaksi;       // Import Transaksi
use App\Models\DetailTransaksi; // Import DetailTransaksi

class CartController extends Controller
{
    /**
     * 1. TAMPILKAN ISI KERANJANG
     */
    public function show()
    {
        if (!Auth::check()) {
            return redirect()->route('login.form');
        }

        $userId = Auth::id();
        $dbCart = Cart::where('user_id', $userId)->get();

        $cart = [];

        foreach ($dbCart as $item) {
            $product = $this->getProduct($item->product_type, $item->product_id);
            $nama = $this->getProductName($item->product_type, $product);

            if ($product) {
                $cart[$item->id] = [
                    'id_keranjang' => $item->id,
                    'product_id' => $item->product_id,
                    'product_type' => $item->product_type,
                    'nama' => $nama,
                    'harga' => $product->harga,
                    'qty' => $item->qty,
                    'gambar' => $product->gambar,
                ];
            }
        }

        // Simpan untuk cart page
        session()->put('cart', $cart);

        return view('cart', compact('cart'));
    }

    /**
     * 2. TAMBAH PRODUK
     */
    public function store(Request $request)
    {
        // Cek Login
        if (!Auth::check()) {
            return redirect()->route('login.form')->with('error', 'Silakan login dahulu untuk belanja.');
        }

        $userId = Auth::id();
        
        $request->validate([
            'id_produk' => 'required',
            'jenis_barang' => 'required',
            'qty' => 'required|integer|min:1'
        ]);

        $idProduk = $request->id_produk;
        $jenis = $request->jenis_barang;
        $qty = $request->qty;

        $cek = Cart::where('user_id', $userId)
            ->where('product_id', $idProduk)
            ->where('product_type', $jenis)
            ->first();

        if ($cek) {
            $cek->qty += $qty;
            $cek->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $idProduk,
                'product_type' => $jenis,
                'qty' => $qty
            ]);
        }

        return redirect()->route('cart.show')->with('success', 'Berhasil ditambahkan!');
    }

    /**
     * 3. UPDATE QTY
     */
    public function update(Request $request, $id)
    {
        $item = Cart::find($id);
        if ($item) {
            $item->qty = $request->qty;
            $item->save();
        }
        return back()->with('success', 'Jumlah diperbarui.');
    }

    /**
     * 4. HAPUS PRODUK
     */
    public function remove($id)
    {
        $item = Cart::find($id);
        if ($item) {
            $item->delete();
        }
        return back()->with('success', 'Produk dihapus.');
    }

    /**
     * 5. CLEAR CART
     */
    public function clear()
    {
        $userId = Auth::id();
        Cart::where('user_id', $userId)->delete();
        session()->forget(['cart', 'checkout_items', 'checkout_total']);
        return back()->with('success', 'Keranjang dikosongkan.');
    }

    /**
     * 6. CHECKOUT — FIX DATA YANG DIKIRIM KE SESSION
     */
    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login.form');
        }

        $userId = Auth::id();
        $dbCart = Cart::where('user_id', $userId)->get();

        $items = [];
        $total = 0;

        foreach ($dbCart as $item) {
            $product = $this->getProduct($item->product_type, $item->product_id);
            $nama = $this->getProductName($item->product_type, $product);

            if ($product) {
                $subtotal = $product->harga * $item->qty;

                $items[] = [
                    // DATA PENTING UNTUK PROSES PAYMENT NANTI
                    'id_asli' => $item->product_id, // ID Produk (misal idOli, idBan)
                    'jenis'   => $item->product_type, // oli, ban, gear, sparepart
                    // Data Tampilan
                    'nama'     => $nama,
                    'harga'    => $product->harga,
                    'qty'      => $item->qty,
                    'image'    => $product->gambar,
                    'subtotal' => $subtotal
                ];

                $total += $subtotal;
            }
        }

        // Simpan ke session untuk halaman pembayaran
        session([
            'checkout_items' => $items,
            'checkout_total' => $total
        ]);

        return redirect()->route('payment.method');
    }

    /**
     * 7. HALAMAN PILIH METODE PEMBAYARAN
     */
    public function paymentMethod()
    {
        $items = session('checkout_items', []);
        $total = session('checkout_total', 0);
        return view('payment_method', compact('items', 'total'));
    }

    /**
     * 8. HALAMAN PAYMENT (setelah memilih metode)
     */
    public function payment()
    {
        $items = session('checkout_items', []);
        $total = session('checkout_total', 0);
        return view('payment', compact('items', 'total'));
    }

    /**
     * 9. PROSES PEMBAYARAN AKHIR (Create Transaksi & Kurangi Stok)
     */
    public function processPayment(Request $request)
    {
        // 1. Ambil Data dari Session
        $cartItems = session('checkout_items');
        $total = session('checkout_total');
        $metode = session('payment_method', 'CASH'); // Default cash jika error
        
        if (!$cartItems) {
            return redirect()->route('cart.show')->with('error', 'Keranjang kosong/sesi habis.');
        }

        // 2. Buat Transaksi
        $transaksi = Transaksi::create([
            'user_id' => Auth::id(),
            'tanggal_transaksi' => Carbon::now(),
            'total_harga' => $total,
            'biaya_admin' => 0, // Bisa disesuaikan
            'metode_pembayaran' => $metode,
            'status_pembayaran' => 'lunas' // Asumsi langsung lunas (Simulasi)
        ]);

        // 3. Simpan Detail & Kurangi Stok
        foreach ($cartItems as $item) {
            
            // Simpan ke Detail Transaksi
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_produk'    => $item['id_asli'],
                'jenis_produk' => $item['jenis'],
                'jumlah'       => $item['qty'],
                'harga_saat_transaksi' => $item['harga'],
                'subtotal'     => $item['subtotal']
            ]);

            // LOGIKA PENGURANGAN STOK
            $prod = null;
            if ($item['jenis'] == 'oli') {
                $prod = Oli::find($item['id_asli']);
            } elseif ($item['jenis'] == 'ban') {
                $prod = Ban::find($item['id_asli']);
            } elseif ($item['jenis'] == 'gear') {
                $prod = Gear::find($item['id_asli']);
            } else {
                $prod = Sparepart::find($item['id_asli']);
            }

            if ($prod) {
                // Pastikan stok tidak negatif
                $prod->stok = max(0, $prod->stok - $item['qty']);
                $prod->save();
            }
        }

        // 4. Bersihkan Keranjang Database & Session
        Cart::where('user_id', Auth::id())->delete();
        session()->forget(['cart', 'checkout_items', 'checkout_total', 'payment_method']);

        // 5. Redirect ke Halaman Sukses
        return redirect()->route('payment.success');
    }

    /**
     * HELPER PRODUK
     */
    private function getProduct($jenis, $id)
    {
        return match ($jenis) {
            'oli' => Oli::find($id),
            'ban' => Ban::find($id),
            'gear' => Gear::find($id),
            default => Sparepart::find($id),
        };
    }

    /**
     * HELPER NAMA PRODUK
     */
    private function getProductName($jenis, $product)
    {
        if (!$product) return '';

        return match ($jenis) {
            'oli' => $product->namaOli,
            'ban' => $product->namaBan,
            'gear' => $product->namaGear,
            default => $product->namaSparepart,
        };
    }
}