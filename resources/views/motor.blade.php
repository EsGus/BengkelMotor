<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Motor - AXERA MOTOR</title>

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
            max-width: 1000px;
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

        .actions {
            display: flex;
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
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="header">
            <div class="header-left">
                <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Kembali ke Home</a>
                <h1>🏍️ Data Master Motor</h1>
            </div>
            <a href="{{ route('motor.create') }}" class="btn-primary">
                <i class="fas fa-plus"></i> Tambah Motor
            </a>
        </div>

        <div style="overflow-x:auto;">
            <table>
                <thead>
                <tr>
                    <th>Nama Motor</th>
                    <th>Tipe Motor</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($motors as $m)
                    <tr>
                        <td><strong>{{ $m->nama_motor }}</strong></td>
                        <td><span class="badge">{{ $m->tipe_motor }}</span></td>
                        <td>
                            <div class="actions" style="justify-content:center;">
                                <a href="{{ route('motor.edit',$m->id) }}" class="btn-action btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('motor.destroy',$m->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data motor ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            <div class="empty">
                                <i class="fas fa-motorcycle"></i>
                                <p>Belum ada data motor</p>
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