<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan - AXERA MOTOR</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
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
            font-weight: 500;
            font-size: 14px;
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
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 5px solid #198754;
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
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge-member { background: #d1e7dd; color: #0f5132; }
        .badge-umum { background: #f8d7da; color: #842029; }

        .motor {
            font-size: 13px;
            color: #555;
        }
        .nopol {
            display: inline-block;
            margin-top: 6px;
            padding: 3px 8px;
            background: #f1f3f5;
            border-radius: 6px;
            font-size: 12px;
            border: 1px dashed #ccc;
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
        .btn-edit { background: #ffc107; }
        .btn-edit:hover { background: #ffcd39; }
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
                <h1>👥 Data Pelanggan</h1>
            </div>
            <a href="{{ route('pelanggan.create') }}" class="btn-primary">
                <i class="fas fa-plus"></i> Tambah Pelanggan
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div style="overflow-x:auto;">
            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Kontak</th>
                    <th>Alamat</th>
                    <th>Motor</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pelanggans as $i => $p)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>
                            <strong>{{ $p->nama_pelanggan }}</strong><br>
                            @if($p->user_id)
                                <span class="badge badge-member"><i class="fas fa-user-check"></i> Member</span>
                            @else
                                <span class="badge badge-umum"><i class="fas fa-user"></i> Umum</span>
                            @endif
                        </td>
                        <td>{{ $p->no_hp }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td class="motor">
                            {{ $p->jenis_motor }}<br>
                            <span class="nopol">{{ $p->no_polisi }}</span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('pelanggan.edit',$p->id) }}" class="btn-action btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('pelanggan.destroy',$p->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty">
                                <i class="fas fa-database"></i>
                                <p>Belum ada data pelanggan</p>
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