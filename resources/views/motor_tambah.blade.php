<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Motor</title>
    <link rel="stylesheet" href="{{ asset('css/dataPegawai.css') }}">
</head>
<body>
    <div class="container" style="padding:20px; max-width:500px; margin:auto;">
        <h2 style="text-align:center;">Tambah Motor Baru</h2>
        
        <form action="{{ route('motor.store') }}" method="POST">
            @csrf
            
            <div class="form-group" style="margin-bottom:15px;">
                <label>Nama Motor</label>
                <input type="text" name="nama_motor" class="form-control" placeholder="Contoh: Honda Beat 2023" required style="width:100%; padding:10px;">
            </div>

            <div class="form-group" style="margin-bottom:15px;">
                <label>Tipe Motor</label>
                <select name="tipe_motor" required style="width:100%; padding:10px;">
                    <option value="Matic">Matic</option>
                    <option value="Bebek">Bebek (Cub)</option>
                    <option value="Sport">Sport / Kopling</option>
                    <option value="Listrik">Listrik</option>
                </select>
            </div>

            <div style="display:flex; justify-content:space-between;">
                <a href="{{ route('motor.index') }}" style="text-decoration:none; color:red;">Batal</a>
                <button type="submit" style="background:blue; color:white; padding:10px 20px; border:none; cursor:pointer;">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>