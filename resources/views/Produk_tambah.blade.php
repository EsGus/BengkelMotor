<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/produk-tambah.css') }}">
    <style>
        /* CSS Sederhana untuk Layout */
        body { font-family: sans-serif; background: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; margin-bottom: 20px; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn-submit { width: 100%; padding: 12px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 10px;}
        .btn-submit:hover { background: #218838; }
        .alert-error { background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 5px; }
        .back-link { display: block; margin-bottom: 20px; color: #007bff; text-decoration: none; }
    </style>
</head>
<body>

<div class="container">
    <a href="{{ url('/home') }}" class="back-link">⬅ Kembali ke Home</a>
    
    <h2>Tambah Produk Baru</h2>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form mengarah ke ProdukController@store --}}
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nama Produk --}}
        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" required placeholder="Contoh: Oli Yamalube / Ban FDR">
        </div>

        {{-- Kategori (MANUAL / HARDCODED) --}}
        {{-- Ini kunci agar controller tahu mau disimpan ke tabel mana --}}
        <div class="form-group">
            <label for="kategori">Kategori Produk</label>
            <select id="kategori" name="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="oli" {{ old('kategori') == 'oli' ? 'selected' : '' }}>Oli Motor</option>
                <option value="ban" {{ old('kategori') == 'ban' ? 'selected' : '' }}>Ban Motor</option>
                <option value="gear" {{ old('kategori') == 'gear' ? 'selected' : '' }}>Gear & Rantai</option>
                <option value="sparepart" {{ old('kategori') == 'sparepart' ? 'selected' : '' }}>Sparepart Lainnya</option>
            </select>
        </div>
        
        {{-- Harga --}}
        <div class="form-group">
            <label for="harga">Harga (Rp)</label>
            <input type="number" id="harga" name="harga" value="{{ old('harga') }}" required min="0">
        </div>  

        {{-- Stok --}}
        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" id="stok" name="stok" value="{{ old('stok') }}" required min="0">
        </div>

        {{-- Gambar --}}
        <div class="form-group">
            <label for="gambar">Gambar (Opsional)</label>
            <input type="file" id="gambar" name="gambar" accept="image/*">
            <small style="color: gray">Format: jpg, png, jpeg. Maks: 2MB</small>
        </div>

        <button type="submit" class="btn-submit">Simpan Produk</button>
    </form>
</div>

</body>
</html>