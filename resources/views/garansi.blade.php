<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Garansi Servis - Axera Motor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f6f8;
            color: #333;
        }
        .hero {
            background: linear-gradient(135deg, #ff7a00, #ff9800);
            color: white;
            padding: 80px 20px;
            text-align: center;
        }
        .hero h1 {
            font-size: 40px;
            margin-bottom: 10px;
        }
        .container {
            max-width: 1100px;
            margin: -40px auto 40px;
            background: white;
            padding: 40px;
            border-radius: 14px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        }
        .section {
            margin-bottom: 35px;
        }
        .section h2 {
            color: #ff8a00;
            margin-bottom: 10px;
        }
        .info-box {
            background: #fafafa;
            border-left: 5px solid #ff9800;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        }
        ul {
            padding-left: 20px;
        }
        ul li {
            margin-bottom: 8px;
        }
        .back {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            background: #ff9800;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
        }
    </style>
</head>
<body>

<section class="hero">
    <h1>Garansi Servis</h1>
    <p>Komitmen Axera Motor untuk Kepuasan Pelanggan</p>
</section>

<div class="container">

    <div class="section">
        <h2>🔒 Komitmen Garansi Kami</h2>
        <p>
            <b>Axera Motor Surabaya</b> memberikan <b>garansi servis</b> sebagai bentuk tanggung jawab
            dan jaminan kualitas atas setiap pekerjaan yang kami lakukan.
            Garansi ini memastikan motor Anda mendapatkan perbaikan yang aman, tepat, dan profesional.
        </p>
    </div>

    <div class="section grid">
        <div class="card">
            <h3>⏱️ Masa Garansi</h3>
            <p>
                Garansi berlaku hingga <b>7 hari</b> atau <b>300 km</b> (mana yang tercapai lebih dulu)
                sejak tanggal servis.
            </p>
        </div>

        <div class="card">
            <h3>🛠️ Cakupan Garansi</h3>
            <ul>
                <li>Kesalahan pemasangan sparepart</li>
                <li>Masalah akibat pengerjaan mekanik</li>
                <li>Komponen yang diservis mengalami kendala ulang</li>
            </ul>
        </div>

        <div class="card">
            <h3>❌ Tidak Termasuk Garansi</h3>
            <ul>
                <li>Kerusakan akibat kecelakaan</li>
                <li>Modifikasi di luar bengkel Axera Motor</li>
                <li>Kelalaian penggunaan oleh pelanggan</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2>📌 Syarat & Ketentuan</h2>
        <div class="info-box">
            <ul>
                <li>Wajib menunjukkan nota servis resmi Axera Motor</li>
                <li>Garansi hanya berlaku untuk pekerjaan yang tercantum di nota</li>
                <li>Garansi tidak dapat diuangkan</li>
                <li>Keputusan akhir berada di pihak bengkel</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2>🤝 Tujuan Kami</h2>
        <p>
            Garansi servis ini dibuat untuk memberikan rasa aman, kepercayaan,
            serta kenyamanan bagi pelanggan dalam menggunakan layanan Axera Motor.
            Kepuasan Anda adalah prioritas utama kami.
        </p>
    </div>

    <a href="{{ route('home') }}" class="back">⬅ Kembali ke Home</a>

</div>

</body>
</html>
 