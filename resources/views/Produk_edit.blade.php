<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk - {{ ucfirst($kategori) }}</title>
    <link rel="stylesheet" href="{{ asset('css/produk-tambah.css') }}">
    <style>
        /* CSS Tambahan sama seperti form tambah */
        body { font-family: sans-serif; background: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn-submit { width: 100%; padding: 12px; background: #ff9800; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 10px;}
        .btn-submit:hover { background: #e68900; }
        .img-preview { margin-top: 10px; max-width: 150px; border: 1px solid #ccc; padding: 5px; border-radius: 5px;}
    </style>
</head>
<body>

<div class="container">
    {{-- LOGIKA TOMBOL KEMBALI YANG BENAR --}}
@php
    $routeKembali = $kategori;
    if ($kategori == 'sparepart') {
        $routeKembali = 'sparepart.index';
    }
@endphp

<a href="{{ route($routeKembali) }}" style="text-decoration: none; color: #007bff;">⬅ Batal & Kembali</a>
    
    <h2 style="text-align: center;">✏ Edit Produk {{ ucfirst($kategori) }}</h2>

    {{-- Form mengarah ke route UPDATE --}}
    <form action="{{ route('produk.update', ['kategori' => $kategori, 'id' => $produk->getKey()]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- PENTING: Mengubah method POST menjadi PUT untuk Update --}}

        {{-- Nama Produk --}}
        <div class="form-group">
            <label>Nama Produk</label>
            {{-- $nama_produk dikirim dari controller --}}
            <input type="text" name="nama_produk" value="{{ $nama_produk }}" required>
        </div>
        
        {{-- Harga --}}
        <div class="form-group">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" value="{{ $produk->harga }}" required>
        </div>  

        {{-- Stok --}}
        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" value="{{ $produk->stok }}" required>
        </div>

        {{-- Gambar --}}
        <div class="form-group">
            <label>Ganti Gambar (Opsional)</label>
            <input type="file" name="gambar" accept="image/*">
            
            @if($produk->gambar)
                <p style="font-size: 12px; color: #666;">Gambar Saat Ini:</p>
                <img src="{{ asset('img/' . $produk->gambar) }}" class="img-preview">
            @endif
        </div>

        <button type="submit" class="btn-submit">Simpan Perubahan</button>
    </form>
</div>

</body>
</html>