<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pegawai</title>
    <link rel="stylesheet" href="{{ asset('css/form-editpegawai.css') }}">
</head>
<body>
    <div class="container">
        <div class="header-link"><a href="{{ route('pegawai.index') }}">⬅ Batal</a></div>
        <h2 class="form-title">✏️ Edit Data Pegawai</h2>
        <div class="form-box">
            {{-- Menggunakan $data->id bukan $data['id'] --}}
            <form action="{{ route('pegawai.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" name="nama" value="{{ $data->nama }}" required>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" value="{{ $data->jabatan }}" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $data->email }}" required>
                </div>
                <div class="form-group">
                    <label>Ganti Foto (Opsional)</label>
                    <input type="file" name="foto">
                </div>
                <div class="form-group">
                    <label>Foto Saat Ini:</label>
                    <div class="current-photo"><img src="{{ asset($data->foto) }}" alt="Foto Lama"></div>
                </div>
                <button type="submit" class="btn-simpan">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</body>
</html>