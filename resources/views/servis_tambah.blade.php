<!DOCTYPE html>
<html>
<head>
    <title>Catat Servis Baru</title>
    <link rel="stylesheet" href="{{ asset('css/form-editpegawai.css') }}">
</head>
<body>
    <div class="container">
        <div class="header-link"><a href="{{ route('servis.index') }}">⬅ Batal</a></div>
        <h2 class="form-title">🔧 Catat Servis Baru</h2>
        
        <div class="form-box">
            <form action="{{ route('servis.store') }}" method="POST">
                @csrf
                
                <div style="background: #f0f8ff; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #cceeff;">
                    <h4 style="margin-top:0; color:#0056b3;">👤 Data Pelanggan</h4>
                    <div class="form-group">
                        <label>Nama Pelanggan / Pemilik</label>
                        <input type="text" name="nama_pelanggan" placeholder="Contoh: Budi Santoso" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor HP / WhatsApp</label>
                        <input type="text" name="no_hp" placeholder="Contoh: 08123456789" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Pilih Motor</label>
                    <select name="idMotor" required style="width:100%; padding:10px;">
                        @foreach($motor as $m) <option value="{{ $m->id }}">{{ $m->nama_motor }}</option> @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Pilih Montir</label>
                    <select name="idMontir" required style="width:100%; padding:10px;">
                        @foreach($montir as $mnt) <option value="{{ $mnt->id }}">{{ $mnt->nama }}</option> @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Servis</label>
                    <input type="date" name="tanggalServis" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label>Keluhan / Jenis Servis</label>
                    <input type="text" name="keluhan" placeholder="Contoh: Ganti Oli + Servis Ringan" required>
                </div>
                
                <div style="background: #fff4e6; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #ffe8cc;">
                    <h4 style="margin-top:0; color:#d9480f;">⚙️ Ganti Sparepart (Opsional)</h4>
                    <div class="form-group">
                        <label>Pilih Sparepart</label>
                        <select name="idSparepart" style="width:100%; padding:10px;">
                            <option value="">-- Tidak Ganti Sparepart --</option>
                            @foreach($sparepart as $sp) 
                                <option value="{{ $sp->idSparepart }}">
                                    {{ $sp->namaSparepart }} (Stok: {{ $sp->stok }} | Rp {{ number_format($sp->harga) }})
                                </option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlahSparepart" value="0" min="0">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Total Biaya (Jasa + Barang) Rp</label>
                    <input type="number" name="totalHarga" required placeholder="0">
                </div>
                
                <button type="submit" class="btn-simpan">Simpan Data Servis</button>
            </form>
        </div>
    </div>
</body>
</html>