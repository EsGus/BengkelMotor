<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AXERA MOTOR - Home</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <!-- Menggunakan Font Poppins agar lebih modern -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk Icon Footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

<!-- HEADER -->
<header class="navbar">
    <div class="nav-container">
        
        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('img/bike.png') }}" alt="Logo Motor" class="logo-icon">
            <div class="logo-text">
                <h1>AXERA MOTOR</h1>
                <p>Bengkel Servis & Sparepart</p>
            </div>
        </a>

        <!-- Search Bar -->
        <div class="search-wrapper">
            <input type="text" class="search-bar" placeholder="Cari sparepart, oli, atau layanan...">
            <button class="search-btn"><i class="fas fa-search"></i></button>
        </div>

        <!-- Menu Kanan -->
        <nav class="nav-links">
            <a href="{{ route('service.form') }}" class="menu-item">Booking Servis</a>
            <a href="{{ route('pegawai.index') }}" class="menu-item">Info Bengkel</a>

            <!-- Cart -->
            <a href="{{ route('cart.show') }}" class="cart-wrapper" title="Keranjang Belanja">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">
                    @auth
                        {{ \App\Models\Cart::where('user_id', Auth::id())->count() }}
                    @else
                        0
                    @endauth
                </span>
            </a>

            <!-- User Auth -->
            <div class="user-section">
                @auth
                    <i class="fas fa-user-circle" style="font-size: 18px; color: white;"></i>
                    <span style="font-size:13px; color: white; font-weight: 500;">{{ Str::limit(Auth::user()->username, 10) }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline; margin-left: 5px;">
                        @csrf
                        <button type="submit" class="logout-btn">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login.form') }}" style="color: white; font-weight:bold; font-size: 14px;">Masuk / Daftar</a>
                @endauth
            </div>
        </nav>
    </div>
</header>

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Solusi Terbaik untuk<br><span class="highlight">Motor Kesayangan Anda!</span></h1>
            <p>Dapatkan suku cadang orisinil dan layanan servis profesional dengan harga terjangkau. Jangan lewatkan promo spesial hari ini.</p>
            
            <a href="{{ route('service.form') }}" class="cta-button">
                <i class="fas fa-calendar-check" style="margin-right:8px;"></i> Booking Servis Sekarang
            </a>
        </div>

        <div class="hero-image">
            <button id="prevBtn" class="slide-btn"><i class="fas fa-chevron-left"></i></button>
            <img id="heroSlide" src="{{ asset('img/home1.jpg') }}" alt="Banner Promo">
            <button id="nextBtn" class="slide-btn"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
</section>

<!-- MAIN MENU / KATEGORI -->
<main>
    <div class="section-header">
        <h2 class="section-title">KATEGORI PRODUK & LAYANAN</h2>
    </div>

    <div class="service-container">
        <a href="{{ route('gear') }}" class="service-box">
            <img src="{{ asset('img/gear.png') }}" alt="Gear">
            <p>Gear Set</p>
        </a>

        <a href="{{ route('oli') }}" class="service-box">
            <img src="{{ asset('img/oli4.png') }}" alt="Oli" onerror="this.src='https://cdn-icons-png.flaticon.com/512/798/798867.png'">
            <p>Oli Mesin</p>
        </a>

        <a href="{{ route('ban') }}" class="service-box">
            <img src="{{ asset('img/ban.png') }}" alt="Ban">
            <p>Ban Motor</p>
        </a>

        <a href="{{ route('sparepart.index') }}" class="service-box">
            <img src="{{ asset('img/crankshaft.png') }}" alt="Sparepart">
            <p>Sparepart Lainnya</p>
        </a>
    </div>
</main>

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

<script>
    let index = 0;
    const images = [
        "{{ asset('img/home1.jpg') }}",
        "{{ asset('img/home2.jpg') }}",
        "{{ asset('img/home3.jpg') }}"
    ];

    function showImage(i) {
        index = (i + images.length) % images.length;
        document.getElementById("heroSlide").src = images[index];
    }

    // Auto slide
    setInterval(() => showImage(index + 1), 5000); 

    // Manual slide
    document.getElementById("prevBtn").onclick = () => showImage(index - 1);
    document.getElementById("nextBtn").onclick = () => showImage(index + 1);
</script>

</body>
</html>