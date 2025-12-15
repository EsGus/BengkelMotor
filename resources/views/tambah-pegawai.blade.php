<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pegawai - AXERA MOTOR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/form-editpegawai.css') }}">
</head>
<body>

    <div class="container">
        
        <div class="header-link">
            <a href="{{ route('pegawai.index') }}">⬅ Batal & Kembali</a>
        </div>

        <h2 class="form-title">➕ Tambah Pegawai Baru</h2>

        <div class="form-box">
            
            <!-- MENAMPILKAN ERROR VALIDASI (PENTING AGAR TAHU KENAPA TIDAK TERSIMPAN) -->
            @if ($errors->any())
                <div style="background: #ffe6e6; color: #d63031; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #fab1a0;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" name="nama" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                </div>

                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" placeholder="Contoh: Mekanik Senior" value="{{ old('jabatan') }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="email@contoh.com" value="{{ old('email') }}" required>
                </div>

                <!-- BAGIAN INI DIUBAH MENJADI OPSIONAL -->
                <div class="form-group">
                    <label>Upload Foto (Opsional)</label>
                    <div class="file-input-wrapper">
                        <!-- 'required' dihapus dari sini -->
                        <input type="file" name="foto"> 
                    </div>
                    <small style="color: #666; font-size: 12px;">*Jika dikosongkan, akan menggunakan foto default.</small>
                </div>

                <button type="submit" class="btn-simpan">Simpan Pegawai</button>

            </form>
        </div>

    </div>

</body>
</html>