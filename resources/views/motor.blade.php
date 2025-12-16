<!DOCTYPE html>
<html lang="id">
<head><title>Data Motor</title><link rel="stylesheet" href="{{ asset('css/dataPegawai.css') }}"></head>
<body>
    <div class="container" style="padding:20px;">
        <a href="{{ route('home') }}">⬅ Kembali ke Home</a>
        <h1>🏍️ Data Master Motor</h1>
        <a href="{{ route('motor.create') }}" class="btn-card" style="background:green; color:white; padding:10px;">+ Tambah Motor</a>
        <br><br>
        <table border="1" cellspacing="0" cellpadding="10" width="100%" style="background:white; border-collapse:collapse;">
            <thead><tr style="background:#ddd;"><th>Nama Motor</th><th>Tipe</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach($motors as $m)
                <tr>
                    <td>{{ $m->nama_motor }}</td>
                    <td>{{ $m->tipe_motor }}</td>
                    <td>
                        <a href="{{ route('motor.edit', $m->id) }}">Edit</a> | 
                        <form action="{{ route('motor.destroy', $m->id) }}" method="POST" style="display:inline;">
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