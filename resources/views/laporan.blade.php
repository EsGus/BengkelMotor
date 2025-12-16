<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Keuangan</title>
    <link rel="stylesheet" href="{{ asset('css/dataPegawai.css') }}">
    <style>
        .summary-box { display: flex; gap: 20px; margin: 20px 0; }
        .card { flex: 1; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
    </style>
</head>
<body>
    <div class="container" style="padding:20px;">
        <a href="{{ route('home') }}">⬅ Kembali ke Home</a>
        <h1>📊 Laporan Keuangan</h1>
        
        <form method="GET" action="{{ route('laporan.index') }}" style="background:white; padding:15px; border-radius:8px;">
            <label>Dari:</label> <input type="date" name="start_date" value="{{ substr($startDate,0,10) }}">
            <label>Sampai:</label> <input type="date" name="end_date" value="{{ substr($endDate,0,10) }}">
            <button type="submit" style="background:#ff8a00; border:none; color:white; padding:5px 15px; border-radius:4px;">Filter</button>
            <button type="button" onclick="window.print()" style="margin-left:10px;">Cetak PDF</button>
        </form>

        <div class="summary-box">
            <div class="card"><h3>Pendapatan Toko</h3><h2>Rp {{ number_format($totalPenjualan) }}</h2></div>
            <div class="card"><h3>Pendapatan Servis</h3><h2>Rp {{ number_format($totalServis) }}</h2></div>
            <div class="card" style="background:#e8f5e9;"><h3>GRAND TOTAL</h3><h2 style="color:green;">Rp {{ number_format($grandTotal) }}</h2></div>
        </div>

        <h3>Rincian Transaksi</h3>
        <table border="1" cellspacing="0" cellpadding="10" width="100%" style="background:white; border-collapse:collapse;">
            <thead><tr style="background:#ddd;"><th>Tanggal</th><th>Sumber</th><th>Keterangan</th><th>Nominal</th></tr></thead>
            <tbody>
                @foreach($penjualan as $p)
                <tr><td>{{ $p->tanggal_transaksi }}</td><td>Toko Online</td><td>Inv #{{ $p->id }}</td><td align="right">Rp {{ number_format($p->total_harga) }}</td></tr>
                @endforeach
                @foreach($servis as $s)
                <tr><td>{{ $s->tanggalServis }}</td><td>Bengkel Servis</td><td>Servis ID #{{ $s->idServis }}</td><td align="right">Rp {{ number_format($s->totalHarga) }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>