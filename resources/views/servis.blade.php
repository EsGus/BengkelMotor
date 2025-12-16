<!DOCTYPE html>
<html lang="id">
<head><title>Admin Servis</title><link rel="stylesheet" href="{{ asset('css/dataPegawai.css') }}"></head>
<body>
    <div class="container" style="padding:20px;">
        <a href="{{ route('home') }}">⬅ Kembali ke Home</a>
        <h1>🔧 Riwayat Servis (Fisik)</h1>
        <a href="{{ route('servis.create') }}" class="btn-card" style="background:green; color:white; padding:10px;">+ Catat Servis Baru</a>
        <br><br>
        <table border="1" cellspacing="0" cellpadding="10" width="100%" style="background:white; border-collapse:collapse;">
            <thead><tr style="background:#ddd;"><th>Tgl</th><th>Motor</th><th>Montir</th><th>Sparepart</th><th>Keluhan</th><th>Total</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach($servis as $s)
                <tr>
                    <td>{{ $s->tanggalServis }}</td>
                    <td>{{ $s->motor->nama_motor ?? 'Umum' }}</td>
                    <td>{{ $s->montir->nama ?? '-' }}</td>
                    <td>{{ $s->sparepart->namaSparepart ?? '-' }} ({{ $s->jumlahSparepart }})</td>
                    <td>{{ $s->keluhan }}</td>
                    <td>Rp {{ number_format($s->totalHarga) }}</td>
                    <td>
                        <a href="{{ route('servis.nota', $s->idServis) }}" target="_blank">🖨️ Nota</a> |
                        <form action="{{ route('servis.destroy', $s->idServis) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus?')">❌</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>