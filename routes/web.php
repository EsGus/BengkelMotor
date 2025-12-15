<?php

use Illuminate\Support\Facades\Route;

// ========== IMPORT CONTROLLER ==========
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarLayananController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\GearController;
use App\Http\Controllers\OliController;
use App\Http\Controllers\BanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BookingServisController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PegawaiController;


// ==============================================================
# 1. ROUTE UMUM (TANPA LOGIN)
// ==============================================================

Route::get('/', fn() => redirect()->route('login.form'));

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/signup', [AuthController::class, 'showForm'])->name('signup.form');
Route::post('/signup', [AuthController::class, 'store'])->name('signup');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==============================================================
# 2. ROUTE MEMBER (HARUS LOGIN - USER BIASA BISA AKSES)
// ==============================================================

Route::middleware(['auth'])->group(function () {

    // ---- HOME ----
    Route::get('/home', fn() => view('home'))->name('home');

    // ---- PRODUK (USER HANYA MELIHAT) ----
    Route::get('/oli', [OliController::class, 'index'])->name('oli');
    Route::get('/ban', [BanController::class, 'index'])->name('ban');
    Route::get('/gear', [GearController::class, 'index'])->name('gear');

    // sparepart hanya index untuk user
    Route::resource('sparepart', SparepartController::class)->only(['index']);

    // ---- KERANJANG BELANJA & CHECKOUT (PERBAIKAN DISINI) ----
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // ===> ROUTE CHECKOUT HARUS DISINI (DI DALAM AUTH, BUKAN ADMIN) <===
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // ---- BOOKING SERVIS ----
    Route::get('/service', [BookingServisController::class, 'create'])->name('service.form');
    Route::post('/service/store', [BookingServisController::class, 'store'])->name('service.store');
    Route::get('/riwayat-service', [BookingServisController::class, 'index'])->name('service.riwayat');

    // ---- PEGAWAI (READ ONLY UNTUK USER) ----
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');

    // ---- LAYANAN (READ ONLY) ----
    Route::resource('daftar-layanan', DaftarLayananController::class)->only(['index']);

    // ---- PEMBAYARAN ----
    Route::get('/payment', [AuthController::class, 'payment'])->name('payment');
    Route::post('/process-payment', [AuthController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment-success', [AuthController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment-method', [AuthController::class, 'paymentMethod'])->name('payment.method');
    Route::post('/choose-payment-method', [AuthController::class, 'choosePaymentMethod'])->name('choose.payment.method');
});


// ==============================================================
# 3. ROUTE KHUSUS ADMIN (JANGAN TARUH CART DISINI)
// ==============================================================

Route::middleware(['auth', 'admin'])->group(function () {

    // ---- CRUD PRODUK UMUM ----
    Route::get('/produk/tambah', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk/simpan', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/edit/{kategori}/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/update/{kategori}/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/hapus/{kategori}/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // ---- CRUD PRODUK PER KATEGORI ----
    Route::post('/oli/store', [OliController::class, 'store'])->name('oli.store');
    Route::post('/ban/store', [BanController::class, 'store'])->name('ban.store');
    Route::post('/gear/store', [GearController::class, 'store'])->name('gear.store');

    // ---- UPDATE STATUS SERVIS ----
    Route::post('/riwayat-service/update/{id}', [BookingServisController::class, 'updateStatus'])->name('service.update');

    // ---- CRUD LAYANAN ----
    Route::resource('daftar-layanan', DaftarLayananController::class)->except(['index']);

    // ---- PEGAWAI (ADMIN CRUD) ----
    Route::get('/pegawai/tambah', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai/simpan', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/hapus/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
});


// ==============================================================
# 4. ROUTE LAMA (KERANJANG TRANSAKSI SIMPAN)
// ==============================================================

Route::post('/detail-transaksi/store', [KeranjangController::class, 'store'])->name('detail-transaksi.store');
Route::get('/pembayaran', [KeranjangController::class, 'pembayaran'])->name('pembayaran');