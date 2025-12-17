<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Axera Motor</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #f4f6f8;
            color: #333;
        }
        .hero {
            background: linear-gradient(135deg, #ff7a00, #ff9800);
            color: white;
            padding: 90px 20px;
            text-align: center;
        }
        .container {
            max-width: 1100px;
            margin: -50px auto 50px;
            background: white;
            padding: 45px;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        }
        h2 {
            color: #ff7a00;
            margin-bottom: 15px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px,1fr));
            gap: 30px;
        }
        .info-box {
            background: #fafafa;
            padding: 25px;
            border-radius: 14px;
            border-left: 6px solid #ff9800;
        }
        .info-box p {
            margin: 8px 0;
            font-size: 15px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            font-weight: 500;
            font-size: 14px;
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 6px;
            font-family: 'Poppins', sans-serif;
        }
        textarea {
            resize: vertical;
            min-height: 120px;
        }
        button {
            background: #ff9800;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }
        button:hover {
            background: #ff7a00;
        }
        .back {
            display: inline-block;
            margin-top: 30px;
            background: #eee;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>

<section class="hero">
    <h1>Hubungi Kami</h1>
    <p>Kami Siap Membantu Kebutuhan Servis Motor Anda</p>
</section>

<div class="container">

    <div class="grid">

        <!-- INFO KONTAK -->
        <div class="info-box">
            <h2>📍 Informasi Bengkel</h2>
            <p><b>Nama Bengkel:</b> Axera Motor</p>
            <p><b>Alamat:</b> Surabaya, Jawa Timur</p>
            <p><b>Telepon / WhatsApp:</b> 08xxxxxxxxxx</p>
            <p><b>Email:</b> axeramotor@gmail.com</p>
            <p><b>Jam Operasional:</b><br>
                Senin – Sabtu : 08.00 – 17.00<br>
                Minggu : Libur
            </p>
        </div>

        <!-- FORM KONTAK -->
        <div class="info-box">
            <h2>✉️ Kirim Pesan</h2>

            {{-- Form ini masih UI (belum disimpan ke database) --}}
            <form>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" placeholder="Masukkan nama Anda">
                </div>

                <div class="form-group">
                    <label>Email / No HP</label>
                    <input type="text" placeholder="Email atau nomor HP">
                </div>

                <div class="form-group">
                    <label>Pesan</label>
                    <textarea placeholder="Tulis pesan Anda..."></textarea>
                </div>

                <button type="submit">Kirim Pesan</button>
            </form>
        </div>

    </div>

    <a href="{{ route('home') }}" class="back">⬅ Kembali ke Home</a>

</div>

</body>
</html>
