<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Pelanggan</title>
    <link rel="stylesheet" href="{{ asset('css/dataPegawai.css') }}">
</head>
<body>
    <div class="container" style="padding:20px; max-width:600px; margin:auto;">
        <h2 style="text-align:center;">Edit Data Pelanggan</h2>
        
        <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group" style="margin-bottom:15px;">
                <label>Akun User (Read Only)</label>
                <input type="text" value="{{ $pelanggan->user->username ?? 'User Terhapus' }}" readonly style="background:#eee; width:100%; padding:10px;">
            </div>

            <div class="form-group" style="margin-bottom:15px;">
                <label>No HP</label>
                <input type="text" name="no_hp" value="{{ $pelanggan->no_hp }}" required style="width:100%; padding:10px;">
            </div>

            <div class="form-group" style="margin-bottom:15px;">
                <label>Alamat</label>
                <textarea name="alamat" rows="3" required style="width:100%; padding:10px;">{{ $pelanggan->alamat }}</textarea>
            </div>

            <div class="form-group" style="margin-bottom:15px;">
                <label>Jenis Motor</label>
                <input type="text" name="jenis_motor" value="{{ $pelanggan->jenis_motor }}" required style="width:100%; padding:10px;">
            </div>

            <div class="form-group" style="margin-bottom:15px;">
                <label>Nomor Polisi</label>
                <input type="text" name="no_polisi" value="{{ $pelanggan->no_polisi }}" required style="width:100%; padding:10px;">
            </div>

            <div style="display:flex; justify-content:space-between;">
                <a href="{{ route('pelanggan.index') }}" style="text-decoration:none; color:red;">Batal</a>
                <button type="submit" style="background:green; color:white; padding:10px 20px; border:none; cursor:pointer;">Update</button>
            </div>
        </form>
    </div>
</body>
</html>