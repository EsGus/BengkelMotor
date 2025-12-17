<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Servis Fisik - AXERA MOTOR</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            margin: 0;
            color: #333;
        }
        .container {
            max-width: 1300px;
            margin: 30px auto;
            padding: 20px;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,.06);
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header-left a {
            text-decoration: none;
            color: #6c757d;
            font-size: 14px;
            font-weight: 500;
        }
        .header-left h1 {
            margin: 8px 0 0;
            font-size: 24px;
            font-weight: 600;
        }
        .btn-primary {
            background: #198754;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: .2s;
        }
        .btn-primary:hover { background: #157347; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        thead {
            background: #212529;
            color: #fff;
        }
        th, td {
            padding: 14px 12px;
            font-size: 14px;
            vertical-align: top;
        }
        th { text-align: left; font-weight: 500; }
        tbody tr {
            border-bottom: 1px solid #eee;
            transition: background .15s;
        }
        tbody tr:hover { background: #f8f9fa; }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            background: #e9ecef;
            color: #495057;
        }
        .price {
            font-weight: 600;
            color: #198754;
        }
        .actions {
            display: flex;
            justify-content: center;
            gap: 8px;
        }
        .btn-action {
            border: none;
            padding: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            transition: .2s;
        }
        .btn-print { background: #0d6efd; color: #fff; }
        .btn-print:hover { background: #0b5ed7; }
        .btn-delete { background: #dc3545; color: #fff; }
        .btn-delete:hover { background: #bb2d3b; }

        .empty {
            text-align: center;
            padding: 40px;
            color: #777;
        }
        .empty i {
            font-size: 36px;
            margin-bottom: 10px;
            color: #adb5bd;
        }

        @media (max-width: 768px) {
            th, td { font-size: 13px; }
            .header { flex-direction: column; align-items: flex-start; gap: 12px; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="header">
            <div class="header-left">
                <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Kembali ke Home</a>
                <h1>🔧 Riwayat Servis (Fisik)</h1>
            </div>
            <a href="{{ route('servis.create') }}" class="btn-primary">
                <i class="fas fa-plus"></i> Catat Servis Baru
            </a>
        </div>

        <div style="overflow-x:auto;">
            <table>
                <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Motor</th>
                    <th>Montir</th>
                    <th>Sparepart</th>
                    <th>Keluhan</th>
                    <th>Total</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($servis as $s)
                    <tr>
                        <td>{{ $s->tanggalServis }}</td>
                        <td>{{ $s->motor->nama_motor ?? 'Umum' }}</td>
                        <td>{{ $s->montir->nama ?? '-' }}</td>
                        <td>
                            @if($s->sparepart)
                                {{ $s->sparepart->namaSparepart }}
                                <span class="badge">x{{ $s->jumlahSparepart }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $s->keluhan }}</td>
                        <td class="price">Rp {{ number_format($s->totalHarga) }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('servis.nota',$s->idServis) }}" target="_blank" class="btn-action btn-print" title="Cetak Nota"><i class="fas fa-print"></i></a>
                                <form action="{{ route('servis.destroy',$s->idServis) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data servis ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty">
                                <i class="fas fa-tools"></i>
                                <p>Belum ada data servis</p>
                            </div>
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