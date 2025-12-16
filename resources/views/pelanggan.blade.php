<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan - AXERA MOTOR</title>
    
    <link rel="stylesheet" href="{{ asset('css/dataPegawai.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .container { padding: 20px; max-width: 1200px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .badge-member { background: #d1e7dd; color: #0f5132; padding: 3px 8px; border-radius: 4px; font-size: 0.8em; font-weight: bold; }
        .badge-umum { background: #f8d7da; color: #842029; padding: 3px 8px; border-radius: 4px; font-size: 0.8em; font-weight: bold; }
        .btn-action { text-decoration: none; padding: 5px 10px; border-radius: 4px; font-size: 14px; margin: 0 2px; }
        .btn-edit { background: #ffc107; color: #000; }
        .btn-delete { background: #dc3545; color: #fff; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <div>
                <a href="{{ route('home') }}" style="text-decoration: none; color: #555; font-weight: bold;">
                    <i class="fas fa-arrow-left"></i> Kembali ke Home
                </a>
                <h1 style="margin-top: 10px;">👥 Data Pelanggan</h1>
            </div>
            <a href="{{ route('pelanggan.create') }}" class="btn-card" style="background: blue; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                <i class="fas fa-plus"></i> Tambah Pelanggan
            </a>
        </div>

        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div style="overflow-x: auto;">
            <table border="1" cellspacing="0" cellpadding="12" width="100%" style="background: white; border-collapse: collapse; border: 1px solid #ddd;">
                <thead style="background: #343a40; color: white;">
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama Pelanggan</th>
                        <th width="15%">Kontak (HP)</th>
                        <th width="25%">Alamat</th>
                        <th width="15%">Motor & Nopol</th>
                        <th width="15%" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggans as $index => $p)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td>{{ $index + 1 }}</td>
                        
                        <td>
                            <div style="font-weight: bold; font-size: 16px;">
                                {{ $p->nama_pelanggan }} 
                            </div>
                            
                            <div style="margin-top: 5px;">
                                @if($p->user_id) 
                                    <span class="badge-member"><i class="fas fa-user-check"></i> Member</span>
                                @else
                                    <span class="badge-umum"><i class="fas fa-user"></i> Umum</span>
                                @endif
                            </div>
                        </td>

                        <td>{{ $p->no_hp }}</td>
                        <td>{{ $p->alamat }}</td>
                        
                        <td>
                            <div>{{ $p->jenis_motor }}</div>
                            <div style="background: #eee; display: inline-block; padding: 2px 6px; border-radius: 3px; font-size: 12px; margin-top: 4px; border: 1px solid #ccc;">
                                {{ $p->no_polisi }}
                            </div>
                        </td>

                        <td style="text-align: center;">
                            <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn-action btn-edit" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus data pelanggan ini?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 30px; background: #f9f9f9; color: #777;">
                            <i class="fas fa-info-circle" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
                            Belum ada data pelanggan. Silakan tambah data baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>