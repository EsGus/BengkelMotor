<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Servis - AXERA MOTOR</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS -->
     <link rel="stylesheet" href="{{ asset('css/formservis.css') }}">
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
            <a href="{{ route('service.riwayat') }}" style="font-weight:bold;">Riwayat Booking</a>
            <div class="user-section">
                @auth
                    <span style="color:white; font-size:13px;">{{ Str::limit(Auth::user()->username, 10) }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">@csrf <button class="logout-btn">Keluar</button></form>
                @else
                    <a href="{{ route('login.form') }}" style="font-weight:bold;">Login</a>
                @endauth
            </div>
        </nav>
    </div>
</header>

<!-- MAIN CONTENT -->
<main class="main-content">
    <div class="form-header">
        <h2>Booking Servis Online</h2>
        <p>Isi data diri dan kendaraan Anda untuk menjadwalkan servis tanpa antre.</p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="form-card">
        <form action="{{ route('service.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
            </div>

            <div class="form-row">
                <label for="no_hp">No Handphone (WhatsApp)</label>
                <input type="tel" id="no_hp" name="no_hp" placeholder="08..." required>
            </div>

            <div class="form-row">
                <label for="nopol">Nomor Polisi Kendaraan</label>
                <input type="text" id="nopol" name="nopol" placeholder="Contoh: B 1234 XYZ" required>
            </div>

            <div class="form-row">
                <label for="tipe_motor">Tipe Motor</label>
                <input type="text" id="tipe_motor" name="tipe_motor" placeholder="Contoh: Vario 150, Nmax, Beat" required>
            </div>

            <div class="form-row">
                <label for="tgl_servis">Tanggal Rencana Servis</label>
                <input type="date" id="tgl_servis" name="tgl_servis" required>
            </div>

            <div class="form-row">
                <label for="jam">Jam Rencana Servis</label>
                <div class="time-select">
                    <select name="jam" id="jam" required>
                        <option value="">Pilih Jam</option>
                        @for ($i = 8; $i <= 17; $i++)
                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                        @endfor
                    </select>
                    <select name="menit" id="menit" required>
                        <option value="">Pilih Menit</option>
                        <option value="00">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <label for="keluhan">Keluhan (Opsional)</label>
                <input type="text" id="keluhan" name="keluhan" placeholder="Contoh: Ganti oli, rem bunyi, servis rutin">
            </div>

            <button type="submit" class="btn-kirim"><i class="fas fa-paper-plane"></i> Kirim Booking</button>
        </form>
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

</body>
</html>