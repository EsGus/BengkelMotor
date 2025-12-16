<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Servis;
use Illuminate\Support\Facades\Redirect;
use App\Models\Cart;

class AuthController extends Controller
{
    // ==============================
    // AUTH
    // ==============================

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

        return back()->withErrors(['username' => 'Username atau password salah']);
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
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return back()->with('success', 'Akun berhasil dibuat!');
    }

   // ==============================
// PAYMENT METHOD
// ==============================
public function paymentMethod()
{
    $items = session('checkout_items', []);
    $total = session('checkout_total', 0);

    if (empty($items)) {
        return redirect()->route('cart.show');
    }

    return view('payment_method', compact('items', 'total'));
}

public function choosePaymentMethod(Request $request)
{
    $request->validate([
        'method' => 'required'
    ]);

    session(['payment_method' => $request->method]);

    if ($request->method === 'qris') {
        return redirect()->route('payment.qris');
    }

    if ($request->method === 'transfer') {
        return redirect()->route('payment.transfer');
    }

    return redirect()->route('payment'); // cash
}

// ==============================
// PAYMENT PAGE
// ==============================
public function payment()
{
    $items = session('checkout_items', []);
    $total = session('checkout_total', 0);

    return view('payment', compact('items', 'total'));
}

public function qris()
{
    $items = session('checkout_items', []);
    $total = session('checkout_total', 0);

    return view('qris', compact('items', 'total'));
}

public function transfer()
{
    $items = session('checkout_items', []);
    $total = session('checkout_total', 0);

    return view('transfer', compact('items', 'total'));
}

public function processPayment()
{
    if (Auth::check()) {
        Cart::where('user_id', Auth::id())->delete();
    }

    session()->forget([
        'cart',
        'checkout_items',
        'checkout_total',
        'payment_method'
    ]);

    return redirect()->route('payment.success');
}

public function paymentSuccess()
{
    return view('payment-success');
}

    // ==============================
    // SERVICE
    // ==============================

    public function serviceCreate()
    {
        return view('formservice');
    }

    public function serviceView(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'nopol' => 'required',
            'tipe_motor' => 'required',
            'tgl_servis' => 'required|date',
            'jam' => 'required',
            'menit' => 'required',
            'keluhan' => 'nullable',
        ]);

        $waktu_servis = $validated['tgl_servis'].' '.$validated['jam'].':'.$validated['menit'].':00';

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
            return Redirect::back()->with('error', 'Gagal menyimpan data');
        }

        return redirect()->route('home')->with('success', 'Data servis berhasil dikirim!');
    }
}
