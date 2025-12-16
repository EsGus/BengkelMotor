<!DOCTYPE html>
<html>
<head><title>Edit Motor</title><link rel="stylesheet" href="{{ asset('css/form-editpegawai.css') }}"></head>
<body>
    <div class="container">
        <h2>Edit Motor</h2>
        <form action="{{ route('motor.update', $motor->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group"><label>Nama Motor</label><input type="text" name="nama_motor" value="{{ $motor->nama_motor }}" required></div>
            <div class="form-group"><label>Tipe</label><input type="text" name="tipe_motor" value="{{ $motor->tipe_motor }}" required></div>
            <button type="submit" class="btn-simpan">Update</button>
        </form>
    </div>
</body>
</html>