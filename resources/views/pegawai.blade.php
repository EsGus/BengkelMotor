<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pegawai - AXERA MOTOR</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dataPegawai.css') }}">
</head>
<body>

<div id="modeBanner" class="mode-active-banner">
    <span>🔧 MODE ADMIN PEGAWAI</span>
    <button onclick="switchMode('view')" style="margin-left:10px; cursor:pointer; padding: 2px 8px;">Selesai</button>
</div>

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
                    @if(Auth::user()->role == 'admin')
                        <button onclick="toggleMenu()" style="background:none; border:none; color:white; cursor:pointer;">⋮</button>
                        <div id="menuDropdown" style="display:none; position:absolute; top:40px; right:0; background:white; color:black; padding:10px; border-radius: 8px;">
                            <a href="{{ route('pegawai.create') }}" style="display:block; padding:8px;">➕ Tambah Pegawai</a>
                            <a href="#" onclick="switchMode('admin'); return false;" style="display:block; padding:8px;">⚙️ Edit Mode</a>
                        </div>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">@csrf <button class="logout-btn">Keluar</button></form>
                @endauth
            </div>
        </nav>
    </div>
</header>

<div class="container">
    <div class="page-header"><h2>Tim Profesional Kami</h2></div>
    <div class="pegawai-grid">
        @foreach ($pegawai as $p)
        <div class="pegawai-card">
            <div class="foto-container">
                <img src="{{ asset($p->foto) }}" alt="{{ $p->nama }}" onerror="this.src='https://via.placeholder.com/300?text=No+Image'">
            </div>
            <div class="info">
                <h3>{{ $p->nama }}</h3>
                <p class="jabatan">{{ $p->jabatan }}</p>
                <p class="email"><i class="fas fa-envelope"></i> {{ $p->email }}</p>
                @if(Auth::check() && Auth::user()->role == 'admin')
                <div class="action-mode-admin">
                    <a href="{{ route('pegawai.edit', $p->id) }}" class="btn-card btn-edit"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('pegawai.destroy', $p->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-card btn-hapus" onclick="return confirm('Hapus {{ $p->nama }}?')"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    function toggleMenu() { document.getElementById("menuDropdown").style.display = document.getElementById("menuDropdown").style.display === "block" ? "none" : "block"; }
    function switchMode(mode) {
        let adminActions = document.querySelectorAll('.action-mode-admin');
        let banner = document.getElementById("modeBanner");
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