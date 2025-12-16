<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Booking Servis</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/serviceriwayat.css') }}">
    <style>
        .badge { padding: 5px 10px; border-radius: 5px; color: white; font-weight: bold; font-size: 12px; }
        .bg-warning { background-color: #ffc107; color: #000; } /* Menunggu */
        .bg-success { background-color: #28a745; } /* Proses/Diterima */
        .bg-danger  { background-color: #dc3545; } /* Ditolak */
        .bg-secondary { background-color: #6c757d; } /* Selesai */
        
        .btn-action { border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; color: white; margin: 2px; }
        .btn-accept { background-color: #28a745; }
        .btn-reject { background-color: #dc3545; }
        .btn-delete { background-color: #333; }
    </style>
</head>
<body>

<header class="navbar">
    <div class="nav-container">
        <a href="{{ route('home') }}" class="logo">
            <div class="logo-text"><h1>AXERA MOTOR</h1><p>Riwayat Booking</p></div>
        </a>
        <nav class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('service.form') }}">Booking Baru</a>
        </nav>
    </div>
</header>

<div class="container" style="padding: 20px; max-width: 1000px; margin: 0 auto;">
    
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
            {{ session('error') }}
        </div>
    @endif

    <h2 style="margin-bottom: 20px;">Daftar Antrian Booking</h2>

    <table border="1" cellspacing="0" cellpadding="10" width="100%" style="background:white; border-collapse: collapse; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <thead style="background: #eee;">
            <tr>
                <th>Tanggal / Jam</th>
                <th>Nama Pelanggan</th>
                <th>Motor / Nopol</th>
                <th>Keluhan</th>
                <th style="text-align:center;">Status</th>
                @if(Auth::check() && Auth::user()->role == 'admin')
                <th style="text-align:center;">Aksi Admin</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $b)
            <tr>
                <td>{{ $b->tgl_servis }}<br><b>{{ $b->jam_servis }}</b></td>
                <td>{{ $b->nama_pelanggan }}<br><small>{{ $b->no_hp }}</small></td>
                <td>{{ $b->tipe_motor }}<br><small>{{ $b->nopol }}</small></td>
                <td>{{ $b->keluhan }}</td>
                
                <td style="text-align:center;">
                    @if($b->status == 'Menunggu')
                        <span class="badge bg-warning">Menunggu</span>
                    @elseif($b->status == 'Proses')
                        <span class="badge bg-success">Diterima / Proses</span>
                    @elseif($b->status == 'Ditolak')
                        <span class="badge bg-danger">Ditolak</span>
                    @else
                        <span class="badge bg-secondary">Selesai</span>
                    @endif
                </td>

                @if(Auth::check() && Auth::user()->role == 'admin')
                <td style="text-align:center; min-width: 150px;">
                    
                    @if($b->status == 'Menunggu')
                        <form action="{{ route('service.update', $b->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-action btn-accept" title="Terima Booking">✔</button>
                        </form>

                        <form action="{{ route('service.tolak', $b->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-action btn-reject" onclick="return confirm('Yakin ingin menolak booking ini?')" title="Tolak Booking">✖</button>
                        </form>
                    @else
                        <form action="{{ route('service.destroy', $b->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Hapus riwayat ini permanen?')" title="Hapus Permanen">🗑️</button>
                        </form>
                    @endif

                </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; padding: 20px;">Belum ada data booking.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>