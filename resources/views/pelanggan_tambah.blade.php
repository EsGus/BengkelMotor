<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Pelanggan</title>
    <link rel="stylesheet" href="{{ asset('css/dataPegawai.css') }}">
</head>
<body>
    <div class="container" style="padding:20px; max-width:600px; margin:auto;">
        <h2 style="text-align:center;">Tambah Data Pelanggan</h2>
        
        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            
            <div class="form-group" style="margin-bottom:15px;">
                <label>Pilih Akun User (Opsional - Untuk Member)</label>
                <select name="user_id" style="width:100%; padding:10px;">
                    <option value="">-- Tanpa Akun / Pelanggan Umum --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                <small style="color:gray;">*Pilih ini jika pelanggan sudah punya akun di aplikasi.</small>
            </div>

            <div class="form-group" style="margin-bottom:15px;">
                <label>Nama Pelanggan</label>
                <input type="text" name="namaPelanggan" placeholder="Isi nama jika tidak punya akun..." style="width:100%; padding:10px;">
            </div>

            <div class="form-group" style="margin-bottom:15px;">
                <label>No HP / WhatsApp</label>
                <input type="text" name="no_hp" placeholder="08..." required style="width:100%; padding:10px;">
            </div>

            <div class="form-group" style="margin-bottom:15px;">
                <label>Alamat Lengkap</label>
                <textarea name="alamat" rows="3" required style="width:100%; padding:10px;"></textarea>
            </div>

            <div class="form-group" style="margin-bottom:15px;">
                <label>Jenis Motor</label>
                <input type="text" name="jenis_motor" placeholder="Contoh: Vario 150" required style="width:100%; padding:10px;">
            </div>

            <div class="form-group" style="margin-bottom:15px;">
                <label>Nomor Polisi (Plat)</label>
                <input type="text" name="no_polisi" placeholder="Contoh: H 1234 XY" required style="width:100%; padding:10px;">
            </div>

            <div style="display:flex; justify-content:space-between;">
                <a href="{{ route('pelanggan.index') }}" style="text-decoration:none; color:red;">Batal</a>
                <button type="submit" style="background:blue; color:white; padding:10px 20px; border:none; cursor:pointer;">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>