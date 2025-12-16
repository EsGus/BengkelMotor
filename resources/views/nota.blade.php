<!DOCTYPE html>
<html>
<head>
    <title>Nota Servis - AXERA MOTOR</title>
    <style>
        body { font-family: monospace; padding: 20px; }
        .header { text-align: center; border-bottom: 2px dashed #000; padding-bottom: 10px; margin-bottom: 10px; }
        .detail { margin-bottom: 10px; }
        .total { font-weight: bold; border-top: 2px dashed #000; padding-top: 10px; text-align: right; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <button onclick="window.print()" class="no-print">🖨️ Cetak Nota</button>
    <div class="header">
        <h2>AXERA MOTOR</h2>
        <p>Jl. Raya Bengkel No. 123, Semarang<br>Telp: 0812-3456-7890</p>
    </div>
    <div class="detail">
        No. Servis : #{{ $servis->idServis }}<br>
        Tanggal    : {{ $servis->tanggalServis }}<br>
        Plat Nomor : {{ $servis->booking ? $servis->booking->nopol : '-' }}<br>
        Motor      : {{ $servis->motor->nama_motor ?? 'Umum' }}
    </div>
    <hr>
    <table style="width:100%">
        <tr>
            <td>Jasa Servis/Keluhan</td>
            <td style="text-align:right">{{ $servis->keluhan }}</td>
        </tr>
        <tr>
            <td>Sparepart ({{ $servis->jumlahSparepart }} pcs)</td>
            <td style="text-align:right">{{ $servis->sparepart->namaSparepart ?? '-' }}</td>
        </tr>
    </table>
    <div class="total">
        TOTAL BAYAR: Rp {{ number_format($servis->totalHarga, 0, ',', '.') }}
    </div>
    <p style="text-align:center; font-size:10px; margin-top:20px;">Terima Kasih atas Kunjungan Anda</p>
</body>
</html>