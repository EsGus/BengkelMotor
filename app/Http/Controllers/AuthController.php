<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Servis; 
use Illuminate\Support\Facades\Redirect;
// WAJIB IMPORT MODEL CART
use App\Models\Cart; 

class AuthController extends Controller
{
    // ... (fungsi login, logout, register, showLoginForm, showForm, store biarkan saja) ...

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); 
    }

    public function showForm()
    {
        return view('signup');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return back()->with('success', 'Akun berhasil dibuat!');
    }

    // ==============================
    // FITUR PAYMENT
    // ==============================
    
    public function payment()
    {
        $items = session('checkout_items', []);
        $total = session('checkout_total', 0);

        if (empty($items)) {
            return redirect()->route('cart.show')->with('error', 'Keranjang belanja kosong');
        }

        return view('payment', compact('items', 'total'));
    }

    public function processPayment(Request $request)
    {
        // 1. (Opsional) Simpan ke tabel Transaksi/Detail Transaksi di sini
        // ...
        
        // 2. HAPUS DATA DARI DATABASE CART (INI YANG KURANG KEMARIN)
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        }

        // 3. Hapus session keranjang
        session()->forget(['cart', 'checkout_items', 'checkout_total', 'payment_method']);
        
        return redirect()->route('payment.success')->with('success', 'Pembayaran berhasil!');
    }

    public function paymentSuccess()
    {
        return view('payment-success');
    }

    // ==============================
    // FITUR PEMILIHAN METODE PEMBAYARAN
    // ==============================

    public function paymentMethod(Request $request)
    {
        $total = session('checkout_total', 0);
        $items = session('checkout_items', []);

        if ($total == 0 || empty($items)) {
            return redirect()->route('cart.show');
        }

        return view('payment_method', compact('items', 'total'));
    }

    public function choosePaymentMethod(Request $request)
    {
        $request->validate([
            'method' => 'required|string'
        ]);

        $method = $request->method;
        session(['payment_method' => $method]);

        return redirect()->route('payment'); 
    }

    // ... (fungsi serviceCreate dan serviceView tetap sama) ...
    public function serviceCreate()
    {
        return view('formservice');
    }

    public function serviceView(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'nopol' => 'required|string|max:10',
            'tipe_motor' => 'required|string|max:50',
            'tgl_servis' => 'required|date',
            'jam' => 'required|string',
            'menit' => 'required|string',
            'keluhan' => 'nullable|string',
        ]);

        $waktu_servis = $validated['tgl_servis'] . ' ' . $validated['jam'] . ':' . $validated['menit'] . ':00';

        try {
            Servis::create([
                'nama' => $validated['nama'],
                'no_handphone' => $validated['no_hp'],
                'nomor_polisi' => $validated['nopol'],
                'tipe_motor' => $validated['tipe_motor'],
                'rencana_servis_at' => $waktu_servis,
                'keluhan' => $validated['keluhan'],
            ]);
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');
        }

        return redirect()->route('home')->with('success', 'Data servis berhasil dikirim!');
    }
}