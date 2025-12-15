<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pegawai - AXERA MOTOR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Menggunakan CSS khusus form -->
    <link rel="stylesheet" href="{{ asset('css/form-editpegawai.css') }}">
</head>
<body>

    <div class="container">
        
        <!-- Header Kecil -->
        <div class="header-link">
            <a href="{{ route('pegawai.index') }}">⬅ Batal & Kembali</a>
        </div>

        <!-- Judul -->
        <h2 class="form-title">✏️ Edit Data Pegawai</h2>

        <!-- Form Container -->
        <div class="form-box">
            <form action="{{ route('pegawai.update', $data['id']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" name="nama" value="{{ $data['nama'] }}" required>
                </div>

                <!-- Jabatan -->
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" value="{{ $data['jabatan'] }}" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $data['email'] }}" required>
                </div>

                <!-- Ganti Foto -->
                <div class="form-group">
                    <label>Ganti Foto (Opsional)</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="foto">
                    </div>
                </div>

                <!-- Preview Foto Lama -->
                <div class="form-group">
                    <label>Foto Saat Ini:</label>
                    <div class="current-photo">
                        <img src="{{ asset($data['foto']) }}" alt="Foto Lama">
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <button type="submit" class="btn-simpan">Simpan Perubahan</button>

            </form>
        </div>

    </div>

</body>
</html>