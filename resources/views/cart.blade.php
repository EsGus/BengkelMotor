<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - AXERA MOTOR</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>

<!-- NAVBAR -->
<header class="navbar">
    <div class="nav-container">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('img/bike.png') }}" class="logo-icon">
            <div class="logo-text"><h1>AXERA MOTOR</h1><p>Bengkel Servis</p></div>
        </a>
        <nav class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('service.form') }}">Booking</a>
            <div class="user-section">
                @auth
                    <span style="color:white; font-size:13px;">{{ Str::limit(Auth::user()->username, 10) }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline; margin-left: 5px;">@csrf <button class="logout-btn">Keluar</button></form>
                @else
                    <a href="{{ route('login.form') }}" style="font-weight:bold;">Login</a>
                @endauth
            </div>
        </nav>
    </div>
</header>

<!-- MAIN CONTENT -->
<div class="container">
    <div class="page-header">
        <h2>Keranjang Belanja</h2>
        <a href="{{ route('home') }}" style="color: var(--primary-orange); font-weight: 600; font-size: 14px;"><i class="fas fa-plus"></i> Tambah Barang Lain</a>
    </div>

    <div class="cart-layout">
        
        <!-- KOLOM KIRI: DAFTAR BARANG -->
        <div class="cart-items-section">
            @if(session('cart') && count(session('cart')) > 0)
                @foreach(session('cart') as $id => $item)
                <div class="cart-item">
                    <input type="checkbox" class="check-item" checked>

                    {{-- Gambar --}}
                    <img src="{{ asset('img/' . ($item['gambar'] ?? 'no-image.jpg')) }}" class="item-img" alt="Produk">

                    <div class="item-info">
                        {{-- Nama Produk --}}
                        <div class="item-name">{{ $item['nama'] }}</div>

                        {{-- Harga Produk --}}
                        <div class="item-price">Rp {{ number_format($item['harga'], 0, ',', '.') }}</div>

                        {{-- Update Qty --}}
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="qty-box">
                            @csrf
                            <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" class="qty-input">
                            <button type="submit" class="update-btn"><i class="fas fa-sync-alt"></i> Update</button>
                        </form>
                    </div>

                    {{-- Tombol Hapus --}}
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        <button class="delete-btn" onclick="return confirm('Hapus item ini?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </div>
                @endforeach
            @else
                <div class="empty-cart">
                    <i class="fas fa-shopping-basket empty-icon"></i>
                    <h3>Keranjang Kosong</h3>
                    <p style="color:#777; margin-bottom: 20px;">Anda belum menambahkan barang apapun.</p>
                    <a href="{{ route('home') }}" class="checkout-btn" style="display:inline-block; width: auto; padding: 10px 30px;">Mulai Belanja</a>
                </div>
            @endif
        </div>

        <!-- KOLOM KANAN: RINGKASAN -->
        @if(session('cart') && count(session('cart')) > 0)
        <div class="cart-summary-section">
            <div class="summary-box">
                <h3>Ringkasan Belanja</h3>
                <div class="summary-row">
                    <span>Total Barang</span>
                    <span>{{ count(session('cart')) }} Item</span>
                </div>
                
                <div class="summary-total">
                    <span>Total Harga</span>
                    {{-- Perhitungan Total Harga --}}
                    <strong>
                        Rp {{ number_format(collect(session('cart'))->sum(fn($i) => $i['harga'] * $i['qty']), 0, ',', '.') }}
                    </strong>
                </div>

                {{-- TOMBOL CHECKOUT (ROUTE TETAP CART.CHECKOUT) --}}
                <a href="{{ route('cart.checkout') }}" class="checkout-btn">Checkout Sekarang</a>

                <form action="{{ route('cart.clear') }}" method="POST" style="margin-top: 10px;">
                    @csrf
                    <button class="clear-btn" onclick="return confirm('Kosongkan semua keranjang?')">Kosongkan Keranjang</button>
                </form>
            </div>
        </div>
        @endif

    </div>
</div>

<!-- FOOTER -->
<footer>
    <div class="footer-content">
        <!-- Kolom 1 -->
        <div class="footer-col">
            <h3>Layanan Pelanggan</h3>
            <ul>
                <li><a href="#">Bantuan</a></li>
                <li><a href="#">Cara Pembelian</a></li>
                <li><a href="#">Lacak Pesanan</a></li>
                <li><a href="#">Garansi Servis</a></li>
                <li><a href="#">Hubungi Kami</a></li>
            </ul>
        </div>

        <!-- Kolom 2 -->
        <div class="footer-col">
            <h3>Jelajahi Axera</h3>
            <ul>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Karir</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
                <li><a href="#">Blog Otomotif</a></li>
                <li><a href="#">Mitra Bengkel</a></li>
            </ul>
        </div>

        <!-- Kolom 3 -->
        <div class="footer-col">
            <h3>Metode Pembayaran</h3>
            <div class="footer-logos">
                <div class="logo-box" title="BCA"><img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="BCA"></div>
                <div class="logo-box" title="BNI"><img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/1200px-BNI_logo.svg.png" alt="BNI"></div>
                <div class="logo-box" title="BRI"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/BANK_BRI_logo.svg/1200px-BANK_BRI_logo.svg.png" alt="BRI"></div>
                <div class="logo-box" title="Mandiri"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/1200px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri"></div>
                <div class="logo-box qris"><span>QRIS</span></div>
                <div class="logo-box" title="Cash"><i class="fas fa-money-bill-wave" style="color:#28a745;"></i></div>
            </div>
        </div>

        <!-- Kolom 4 -->
        <div class="footer-col">
            <h3>Ikuti Kami</h3>
            <ul class="social-links">
                <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                <li><a href="#"><i class="fab fa-tiktok"></i> TikTok</a></li>
                <li><a href="#"><i class="fab fa-youtube"></i> YouTube</a></li>
            </ul>
            <br>
            <h3>Keamanan</h3>
            <div style="display:flex; align-items:center; gap:10px;">
                <i class="fas fa-shield-alt" style="font-size:24px; color:var(--primary-orange);"></i>
                <span style="font-size:12px; line-height:1.2; color:#444;">Transaksi Aman<br>& Terpercaya</span>
            </div>
        </div>
    </div>

    <div class="copyright">
        &copy; {{ date('Y') }} <strong>Axera Motor</strong>. Seluruh Hak Cipta Dilindungi. <br>
        <span style="font-size: 11px;">Dibuat dengan ❤️ untuk kenyamanan berkendara Anda.</span>
    </div>
</footer>



</body>
</html>