<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Motor</title>
    <link rel="stylesheet" href="{{ asset('css/dataPegawai.css') }}">
</head>
<body>
    <div class="container" style="padding:20px; max-width:500px; margin:auto;">
        <h2 style="text-align:center;">Edit Data Motor</h2>
        
        <form action="{{ route('motor.update', $motor->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group" style="margin-bottom:15px;">
                <label>Nama Motor</label>
                <input type="text" name="nama_motor" value="{{ $motor->nama_motor }}" required style="width:100%; padding:10px;">
            </div>

            <div class="form-group" style="margin-bottom:15px;">
                <label>Tipe Motor</label>
                <select name="tipe_motor" required style="width:100%; padding:10px;">
                    <option value="Matic" {{ $motor->tipe_motor == 'Matic' ? 'selected' : '' }}>Matic</option>
                    <option value="Bebek" {{ $motor->tipe_motor == 'Bebek' ? 'selected' : '' }}>Bebek (Cub)</option>
                    <option value="Sport" {{ $motor->tipe_motor == 'Sport' ? 'selected' : '' }}>Sport / Kopling</option>
                    <option value="Listrik" {{ $motor->tipe_motor == 'Listrik' ? 'selected' : '' }}>Listrik</option>
                </select>
            </div>

            <div style="display:flex; justify-content:space-between;">
                <a href="{{ route('motor.index') }}" style="text-decoration:none; color:red;">Batal</a>
                <button type="submit" style="background:green; color:white; padding:10px 20px; border:none; cursor:pointer;">Update</button>
            </div>
        </form>
    </div>
</body>
</html>