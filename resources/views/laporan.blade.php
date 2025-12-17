<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <link rel="stylesheet" href="{{ asset('css/dataPegawai.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .summary-box { display: flex; gap: 20px; margin: 20px 0; }
        .card { flex: 1; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        
        /* Styling Tabel Rapi */
        table { border-collapse: collapse; width: 100%; background: white; }
        th, td { border: 1px solid #ddd; padding: 12px; }
        th { background-color: #343a40; color: white; text-align: left; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:hover { background-color: #f1f1f1; }
        
        /* Badge Sumber */
        .badge-toko { background: #e7f1ff; color: #0d6efd; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 0.9em; }
        .badge-servis { background: #fff3cd; color: #856404; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="container" style="padding:20px; max-width: 1200px; margin: 0 auto;">
        
        <div style="margin-bottom: 20px;">
            <a href="{{ route('home') }}" style="text-decoration: none; color: #555; font-weight: bold;">
                <i class="fas fa-arrow-left"></i> Kembali ke Home
            </a>
            <h1 style="margin-top: 10px;">📊 Laporan Keuangan</h1>
        </div>
        
        <form method="GET" action="{{ route('laporan.index') }}" style="background:white; padding:15px; border-radius:8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <div>
                <label>Dari:</label> 
                <input type="date" name="start_date" value="{{ $startDate }}" style="padding: 5px;">
            </div>
            <div>
                <label>Sampai:</label> 
                <input type="date" name="end_date" value="{{ $endDate }}" style="padding: 5px;">
            </div>
            
            <button type="submit" style="background:#ff8a00; border:none; color:white; padding:7px 15px; border-radius:4px; cursor: pointer;">
                <i class="fas fa-filter"></i> Filter
            </button>
            <button type="button" onclick="window.print()" style="background: #333; color: white; border: none; padding: 7px 15px; border-radius: 4px; cursor: pointer;">
                <i class="fas fa-print"></i> Cetak PDF
            </button>
        </form>

        <div class="summary-box">
            <div class="card">
                <h3>Pendapatan Toko</h3>
                <h2 style="color: blue;">Rp {{ number_format($pendapatanToko, 0, ',', '.') }}</h2>
            </div>
            <div class="card">
                <h3>Pendapatan Servis</h3>
                <h2 style="color: orange;">Rp {{ number_format($pendapatanServis, 0, ',', '.') }}</h2>
            </div>
            <div class="card" style="background:#e8f5e9; border: 1px solid #c8e6c9;">
                <h3>GRAND TOTAL</h3>
                <h2 style="color:green;">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h2>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <h3>Rincian Transaksi (Gabungan & Terurut)</h3>
            <div style="overflow-x: auto;">
                <table width="100%">
                    <thead>
                        <tr>
                            <th>Tanggal & Waktu</th>
                            <th>Sumber Pemasukan</th>
                            <th>Keterangan</th>
                            <th style="text-align:right;">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataLaporan as $row)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($row['tanggal'])->translatedFormat('d F Y H:i') }}</td>
                            
                            <td>
                                @if($row['sumber'] == 'Toko Online')
                                    <span class="badge-toko">Toko Online</span>
                                @else
                                    <span class="badge-servis">Bengkel Servis</span>
                                @endif
                            </td>
                            
                            <td>{{ $row['keterangan'] }}</td>
                            
                            <td style="text-align:right; font-family: monospace; font-size: 1.1em;">
                                Rp {{ number_format($row['nominal'], 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center; padding: 30px; color: #777;">
                                <i class="fas fa-info-circle"></i> Tidak ada transaksi pada periode tanggal ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>