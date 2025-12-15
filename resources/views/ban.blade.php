<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AXERA MOTOR - Ban</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/ban.css') }}">
</head>
<body>

<div id="modeBanner" class="mode-active-banner">
    <span id="modeText">🔧 MODE ADMIN</span>
    <button onclick="switchMode('buy')" style="margin-left:10px; cursor:pointer;">Keluar</button>
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
            <a href="{{ route('cart.show') }}" class="cart-wrapper">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">@auth {{ \App\Models\Cart::where('user_id', Auth::id())->count() }} @else 0 @endauth</span>
            </a>
            <div class="user-section">
                @auth
                    <span style="color:white; font-size:13px;">{{ Str::limit(Auth::user()->username, 10) }}</span>
                    @if(Auth::user()->role == 'admin')
                        <button onclick="document.getElementById('menuDropdown').style.display='block'" style="background:none; border:none; color:white; cursor:pointer;">⋮</button>
                        <div id="menuDropdown" style="display:none; position:absolute; top:40px; right:0; background:white; color:black; padding:10px; box-shadow:0 5px 15px rgba(0,0,0,0.2);">
                            <a href="/produk/tambah" style="display:block; padding:5px;">➕ Tambah</a>
                            <a href="#" onclick="switchMode('admin'); return false;" style="display:block; padding:5px;">⚙️ Edit</a>
                        </div>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">@csrf <button class="logout-btn">Keluar</button></form>
                @else
                    <a href="{{ route('login.form') }}" style="font-weight:bold;">Login</a>
                @endauth
            </div>
        </nav>
    </div>
</header>

<div class="container">
    <h1>🛞 Koleksi Ban Motor</h1>
    <div class="search-box"><input type="text" id="searchInput" placeholder="Cari Ban..."></div>

    <div class="product-grid">
        @if($bans->isEmpty()) <p style="grid-column: 1/-1; text-align: center;">Belum ada data Ban.</p> @else
            @foreach ($bans as $b)
            <div class="product-card">
                <img src="{{ asset('img/' . ($b->gambar ? $b->gambar : 'no-image.jpg')) }}" alt="{{ $b->namaBan }}">
                <p class="product-name">{{ $b->namaBan }}</p>
                <p class="price">Rp{{ number_format($b->harga, 0, ',', '.') }}</p>

                <div class="quantity-control action-mode-buy">
                    <button onclick="changeQty(this, -1)">-</button>
                    <input type="text" value="0" readonly>
                    <button onclick="changeQty(this, 1)">+</button>
                </div>

                <div class="action-mode-buy" style="width:100%">
                    <form action="{{ route('cart.add') }}" method="POST" onsubmit="return validateQty(this)">
                        @csrf
                        <input type="hidden" name="id_produk" value="{{ $b->idBan }}">
                        <input type="hidden" name="jenis_barang" value="ban">
                        <input type="hidden" class="qty-input" name="qty" value="0">
                        <button class="buy-btn"><i class="fas fa-shopping-bag"></i> Beli</button>
                    </form>
                </div>

                @if(Auth::user()->role == 'admin')
                <div class="action-mode-admin" style="width:100%">
                    <div class="admin-buttons-container">
                        <a href="{{ route('produk.edit', ['kategori' => 'ban', 'id' => $b->idBan]) }}" class="btn-edit-card">✏ Edit</a>
                        <form action="{{ route('produk.destroy', ['kategori' => 'ban', 'id' => $b->idBan]) }}" method="POST" onsubmit="return confirm('Hapus?');" style="flex:1;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete-card">🗑 Hapus</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
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

<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let cards = document.getElementsByClassName("product-card");
    for (let card of cards) {
        let name = card.querySelector(".product-name").innerText.toLowerCase();
        card.style.display = name.includes(filter) ? "" : "none";
    }
});
function switchMode(mode) {
    let buyElements = document.querySelectorAll('.action-mode-buy');
    let adminElements = document.querySelectorAll('.action-mode-admin');
    let banner = document.getElementById("modeBanner");
    let menu = document.getElementById("menuDropdown");
    
    buyElements.forEach(el => el.style.display = 'none');
    adminElements.forEach(el => el.style.display = 'none');
    banner.style.display = 'none';
    if(menu) menu.style.display = 'none';

    if (mode === 'buy') {
        buyElements.forEach(el => el.style.display = 'flex');
        document.querySelectorAll('.action-mode-buy form').forEach(e => e.parentElement.style.display = 'block');
    } else if (mode === 'admin') {
        adminElements.forEach(el => el.style.display = 'block');
        banner.style.display = 'block';
    }
}
function changeQty(button, delta) {
    const input = button.parentElement.querySelector('input[type="text"]');
    const form = button.closest('.product-card').querySelector('form');
    let value = parseInt(input.value);
    value = Math.max(0, value + delta);
    input.value = value;
    form.querySelector('.qty-input').value = value;
}
function validateQty(form) {
    const qty = parseInt(form.querySelector('.qty-input').value);
    if (qty === 0) { alert('Jumlah harus > 0!'); return false; }
    return true;
}
</script>
</body>
</html>