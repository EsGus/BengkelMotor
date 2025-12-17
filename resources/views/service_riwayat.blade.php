<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking Servis - AXERA MOTOR</title>

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
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }
        .card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,.06);
            padding: 22px;
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
            background: #0d6efd;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: .2s;
        }
        .btn-primary:hover { background: #0b5ed7; }

        .alert-success {
            background: #e9f7ef;
            color: #0f5132;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 5px solid #198754;
        }
        .alert-error {
            background: #f8d7da;
            color: #842029;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 5px solid #dc3545;
        }

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
            display: inline-flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            color: #fff;
        }
        .bg-warning { background: #ffc107; color: #000; }
        .bg-success { background: #198754; }
        .bg-danger { background: #dc3545; }
        .bg-secondary { background: #6c757d; }

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
            color: #fff;
        }
        .btn-accept { background: #198754; }
        .btn-reject { background: #dc3545; }
        .btn-delete { background: #495057; }

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
                <h1>📅 Riwayat Booking Servis</h1>
            </div>
            <a href="{{ route('service.form') }}" class="btn-primary">
                <i class="fas fa-plus"></i> Booking Baru
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <div style="overflow-x:auto;">
            <table>
                <thead>
                <tr>
                    <th>Tanggal / Jam</th>
                    <th>Pelanggan</th>
                    <th>Motor</th>
                    <th>Keluhan</th>
                    <th style="text-align:center;">Status</th>
                    @if(Auth::check() && Auth::user()->role == 'admin')
                        <th style="text-align:center;">Aksi</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @forelse($bookings as $b)
                    <tr>
                        <td>{{ $b->tgl_servis }}<br><strong>{{ $b->jam_servis }}</strong></td>
                        <td>{{ $b->nama_pelanggan }}<br><small>{{ $b->no_hp }}</small></td>
                        <td>{{ $b->tipe_motor }}<br><small>{{ $b->nopol }}</small></td>
                        <td>{{ $b->keluhan }}</td>
                        <td style="text-align:center;">
                            @if($b->status == 'Menunggu')
                                <span class="badge bg-warning">Menunggu</span>
                            @elseif($b->status == 'Proses')
                                <span class="badge bg-success">Diterima</span>
                            @elseif($b->status == 'Ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-secondary">Selesai</span>
                            @endif
                        </td>
                        @if(Auth::check() && Auth::user()->role == 'admin')
                        <td>
                            <div class="actions">
                                @if($b->status == 'Menunggu')
                                    <form action="{{ route('service.update',$b->id) }}" method="POST">@csrf
                                        <button class="btn-action btn-accept" title="Terima"><i class="fas fa-check"></i></button>
                                    </form>
                                    <form action="{{ route('service.tolak',$b->id) }}" method="POST">@csrf
                                        <button class="btn-action btn-reject" title="Tolak"><i class="fas fa-times"></i></button>
                                    </form>
                                @else
                                    <form action="{{ route('service.destroy',$b->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">@csrf @method('DELETE')
                                        <button class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                @endif
                            </div>
                        </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty">
                                <i class="fas fa-calendar-times"></i>
                                <p>Belum ada data booking servis</p>
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
