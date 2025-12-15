<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai - AXERA MOTOR</title>
    
    <!-- Fonts & Icons -->
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/dataPegawai.css') }}">
</head>
<body>

<!-- Admin Banner -->
<div id="modeBanner" class="mode-active-banner">
    <span>🔧 MODE ADMIN PEGAWAI</span>
    <button onclick="switchMode('view')" style="margin-left:10px; cursor:pointer; padding: 2px 8px; border-radius: 4px; border:none; font-weight:bold;">Selesai</button>
</div>

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
                    
                    {{-- Menu Admin Dropdown --}}
                    @if(Auth::user()->role == 'admin')
                        <button onclick="toggleMenu()" style="background:none; border:none; color:white; cursor:pointer; margin-left:5px;">⋮</button>
                        <div id="menuDropdown" style="display:none; position:absolute; top:40px; right:0; background:white; color:black; padding:10px; box-shadow:0 5px 15px rgba(0,0,0,0.2); border-radius: 8px; z-index: 1002; min-width: 160px;">
                            <a href="{{ route('pegawai.create') }}" style="display:block; padding:8px; font-size: 13px; text-decoration:none; color:#333; border-bottom:1px solid #eee;">
                                <i class="fas fa-plus-circle" style="color:green;"></i> Tambah Pegawai
                            </a>
                            <a href="#" onclick="switchMode('admin'); return false;" style="display:block; padding:8px; font-size: 13px; text-decoration:none; color:#333;">
                                <i class="fas fa-cog" style="color:orange;"></i> Edit Mode
                            </a>
                        </div>
                    @endif

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
        <h2>Tim Profesional Kami</h2>
    </div>

    <div class="pegawai-grid" id="pegawaiList">
        @foreach ($pegawai as $p)
        <div class="pegawai-card">
            <div class="foto-container">
                <img src="{{ asset($p['foto']) }}" alt="{{ $p['nama'] }}" onerror="this.src='https://via.placeholder.com/300?text=No+Image'">
            </div>

            <div class="info">
                <h3>{{ $p['nama'] }}</h3>
                <p class="jabatan">{{ $p['jabatan'] }}</p>
                <p class="email"><i class="fas fa-envelope"></i> {{ $p['email'] }}</p>

                <!-- Tombol Aksi (Hanya muncul jika Mode Admin aktif) -->
                @if(Auth::check() && Auth::user()->role == 'admin')
                <div class="action-mode-admin">
                    <a href="{{ route('pegawai.edit', $p['id']) }}" class="btn-card btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    
                    <form action="{{ route('pegawai.destroy', $p['id']) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-card btn-hapus" onclick="return confirm('Hapus {{ $p['nama'] }}?')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        @endforeach
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

<script>
    function toggleMenu() {
        let menu = document.getElementById("menuDropdown");
        menu.style.display = menu.style.display === "block" ? "none" : "block";
    }

    function switchMode(mode) {
        let adminActions = document.querySelectorAll('.action-mode-admin');
        let banner = document.getElementById("modeBanner");
        let menu = document.getElementById("menuDropdown");

        if(menu) menu.style.display = 'none';

        if (mode === 'admin') {
            adminActions.forEach(el => el.style.display = 'block');
            banner.style.display = 'block';
        } else {
            adminActions.forEach(el => el.style.display = 'none');
            banner.style.display = 'none';
        }
    }
</script>

</body>
</html>