<!DOCTYPE html>
<html lang="id">
<head><title>Data Pelanggan</title><link rel="stylesheet" href="{{ asset('css/dataPegawai.css') }}"></head>
<body>
    <div class="container" style="padding:20px;">
        <a href="{{ route('home') }}">⬅ Kembali ke Home</a>
        <h1>👥 Data Pelanggan</h1>
        <a href="{{ route('pelanggan.create') }}" class="btn-card" style="background:green; color:white; padding:10px;">+ Tambah Pelanggan</a>
        <br><br>
        <table border="1" cellspacing="0" cellpadding="10" width="100%" style="background:white; border-collapse:collapse;">
            <thead><tr style="background:#ddd;"><th>Nama</th><th>No HP</th><th>Alamat</th><th>Motor</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach($pelanggan as $p)
                <tr>
                    <td>{{ $p->namaPelanggan ?? $p->user->name ?? '-' }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->jenis_motor }} ({{ $p->no_polisi }})</td>
                    <td>
                        <a href="{{ route('pelanggan.edit', $p->id) }}">Edit</a> |
                        <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>