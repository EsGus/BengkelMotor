<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking Servis</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/serviceriwayat.css') }}">
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
            <a href="{{ route('service.form') }}">Form Booking</a>
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
<div class="container">
    <div class="page-header">
        <h2>Riwayat Booking Servis</h2>
        <a href="{{ route('service.form') }}" class="back-btn-top"><i class="fas fa-plus"></i> Booking Baru</a>
    </div>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 8px;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Pelanggan</th>
                    <th>Motor & Nopol</th>
                    <th>Jadwal</th>
                    <th>Keluhan</th>
                    <th>Status</th>
                    <th>Aksi Admin</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $index => $b)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $b->nama_pelanggan }}</strong><br>
                        <small style="color: #777;"><i class="fab fa-whatsapp"></i> {{ $b->no_hp }}</small>
                    </td>
                    <td>
                        {{ $b->tipe_motor }}<br>
                        <span style="background:#eee; padding: 2px 6px; border-radius: 4px; font-size: 11px; font-weight:bold;">{{ $b->nopol }}</span>
                    </td>
                    <td>
                        {{ date('d M Y', strtotime($b->tgl_servis)) }}<br>
                        <span style="color: var(--secondary-orange); font-weight: bold; font-size: 12px;">Jam {{ $b->jam_servis }}</span>
                    </td>
                    <td>{{ $b->keluhan ?? '-' }}</td>
                    <td>
                        <span class="status-badge {{ $b->status == 'Selesai' ? 'bg-done' : 'bg-wait' }}">
                            {{ $b->status }}
                        </span>
                    </td>
                    <td>
                        @if(Auth::check() && Auth::user()->role == 'admin')
                            @if($b->status == 'Menunggu')
                                <form action="{{ route('service.update', $b->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-action" onclick="return confirm('Tandai sebagai selesai?')">✅ Selesai</button>
                                </form>
                            @else
                                <span style="color:#aaa; font-style:italic; font-size:12px;"><i class="fas fa-check-double"></i> Selesai</span>
                            @endif
                        @else
                            <span style="font-size: 12px; color: #999;">
                                {{ $b->status == 'Menunggu' ? 'Menunggu Konfirmasi' : 'Selesai' }}
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 50px; color: #888;">
                        <i class="fas fa-clipboard-list" style="font-size: 40px; margin-bottom: 10px; color: #ddd;"></i><br>
                        Belum ada data booking servis.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
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