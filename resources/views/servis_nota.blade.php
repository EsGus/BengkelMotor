<!DOCTYPE html>
<html>
<head>
    <title>Nota Servis #{{ $servis->idServis }}</title>
    <style>
        body { font-family: monospace; padding: 20px; max-width: 350px; margin: auto; border: 1px solid #ddd; }
        .header { text-align: center; border-bottom: 2px dashed #000; padding-bottom: 10px; margin-bottom: 15px; }
        .info-table td { padding: 2px 0; font-size: 13px; }
        .total { font-weight: bold; border-top: 2px dashed #000; padding-top: 10px; text-align: right; margin-top: 10px; font-size: 16px; }
        @media print { .no-print { display: none; } body { border: none; } }
    </style>
</head>
<body>
    <button onclick="window.print()" class="no-print" style="width:100%; padding:10px; margin-bottom:10px; cursor:pointer;">🖨️ CETAK NOTA</button>
    
    <div class="header">
        <h3 style="margin:5px 0;">AXERA MOTOR</h3>
        <p style="margin:0; font-size:12px;">Jl. Raya Bengkel No. 1, Semarang<br>Telp: 0812-3456-7890</p>
    </div>
    
    <table class="info-table" width="100%">
        <tr><td>No. Nota</td><td>: #{{ $servis->idServis }}</td></tr>
        <tr><td>Tanggal</td><td>: {{ $servis->tanggalServis }}</td></tr>
        <tr><td colspan="2"><hr style="border-top:1px dashed #ccc;"></td></tr>
        
        <tr><td><strong>Pelanggan</strong></td><td>: <strong>{{ $servis->nama_pelanggan }}</strong></td></tr>
        <tr><td>No HP</td><td>: {{ $servis->no_hp }}</td></tr>
        <tr><td>Motor</td><td>: {{ $servis->motor->nama_motor ?? 'Umum' }}</td></tr>
        <tr><td>Montir</td><td>: {{ $servis->montir->nama ?? '-' }}</td></tr>
    </table>
    
    <hr style="border-top:2px dashed #000;">
    
    <table width="100%" style="font-size:13px;">
        <tr>
            <td><strong>Jasa / Keluhan</strong><br>{{ $servis->keluhan }}</td>
            <td align="right" valign="top">-</td>
        </tr>
        
        @if($servis->idSparepart)
        <tr>
            <td style="padding-top:10px;">
                <strong>Sparepart</strong><br>
                {{ $servis->sparepart->namaSparepart ?? 'Item Terhapus' }}<br>
                x {{ $servis->jumlahSparepart }}
            </td>
            <td align="right" valign="bottom">-</td>
        </tr>
        @endif
    </table>
    
    <div class="total">
        TOTAL BAYAR: Rp {{ number_format($servis->totalHarga, 0, ',', '.') }}
    </div>
    
    <p style="text-align:center; margin-top:20px; font-size:11px;">
        * Barang yang sudah dibeli tidak dapat dikembalikan.<br>
        Terima Kasih Atas Kunjungan Anda!
    </p>
</body>
</html>