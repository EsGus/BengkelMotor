<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BookingServisController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\OliController;
use App\Http\Controllers\BanController;
use App\Http\Controllers\GearController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\DaftarLayananController;

// 1. HALAMAN UTAMA & AUTH
Route::get('/', function () { return redirect()->route('login.form'); });
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/signup', [AuthController::class, 'showForm'])->name('signup.form');
Route::post('/signup', [AuthController::class, 'store'])->name('signup');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 2. MENU PRODUK (PUBLIC)
Route::get('/oli', [OliController::class, 'index'])->name('oli');
Route::get('/ban', [BanController::class, 'index'])->name('ban');
Route::get('/gear', [GearController::class, 'index'])->name('gear');
Route::resource('sparepart', SparepartController::class)->only(['index']);

// 3. FITUR USER (LOGIN REQUIRED)
Route::middleware(['auth'])->group(function () {

    // KERANJANG
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // ALUR CHECKOUT & PEMBAYARAN
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/payment-method', [AuthController::class, 'paymentMethod'])->name('payment.method'); 
    Route::post('/choose-payment-method', [AuthController::class, 'choosePaymentMethod'])->name('choose.payment.method');
    Route::get('/payment', [AuthController::class, 'payment'])->name('payment');
    Route::post('/payment/process', [AuthController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/success', [AuthController::class, 'paymentSuccess'])->name('payment.success');

    // SERVIS
    Route::get('/booking', [BookingServisController::class, 'create'])->name('service.form');
    Route::post('/booking', [BookingServisController::class, 'store'])->name('service.store');
    Route::get('/riwayat-servis', [BookingServisController::class, 'index'])->name('service.riwayat');
    
    // PEGAWAI (READ ONLY)
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
});

// 4. KHUSUS ADMIN
Route::middleware(['auth', 'App\Http\Middleware\IsAdmin'])->group(function () {
    
    // CRUD PRODUK
    Route::get('/produk/tambah', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk/simpan', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/edit/{kategori}/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/update/{kategori}/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/hapus/{kategori}/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // --- MANAJEMEN BOOKING SERVIS ---
    // Terima
    Route::post('/service/update/{id}', [BookingServisController::class, 'updateStatus'])->name('service.update');
    // Tolak (BARU)
    Route::post('/service/tolak/{id}', [BookingServisController::class, 'tolak'])->name('service.tolak');
    // Hapus (BARU)
    Route::delete('/service/hapus/{id}', [BookingServisController::class, 'destroy'])->name('service.destroy');
    
    // --- MANAJEMEN MOTOR (CRUD) ---
    Route::resource('motor', App\Http\Controllers\MotorController::class);

    // --- MANAJEMEN PELANGGAN (CRUD) ---
    Route::resource('pelanggan', App\Http\Controllers\PelangganController::class);

    // --- MANAJEMEN SERVIS ADMIN ---
    Route::resource('servis', App\Http\Controllers\ServisController::class);
    Route::get('/servis/{id}/cetak-nota', [App\Http\Controllers\ServisController::class, 'cetakNota'])->name('servis.nota');

    // --- LAPORAN KEUANGAN ---
    Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');

    // PEGAWAI CRUD
    Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('/pegawai/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
});

// ================================
// ALUR CHECKOUT & PEMBAYARAN
// ================================

Route::get('/payment-method', [AuthController::class, 'paymentMethod'])
    ->name('payment.method');

Route::post('/choose-payment-method', [AuthController::class, 'choosePaymentMethod'])
    ->name('choose.payment.method');

Route::get('/payment', [AuthController::class, 'payment'])
    ->name('payment');

Route::get('/payment/qris', [AuthController::class, 'qris'])
    ->name('payment.qris');

Route::get('/payment/transfer', [AuthController::class, 'transfer'])
    ->name('payment.transfer');

Route::post('/payment/process', [AuthController::class, 'processPayment'])
    ->name('payment.process');

Route::get('/payment/success', [AuthController::class, 'paymentSuccess'])
    ->name('payment.success');

Route::view('/tentang', 'tentang')->name('tentang');

