<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Axera Motor</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #f4f6f8;
            color: #333;
        }

        /* HERO */
        .hero {
            background: linear-gradient(135deg, #ff7a00, #ff9800);
            color: white;
            padding: 90px 20px;
            text-align: center;
        }
        .hero h1 {
            font-size: 44px;
            margin-bottom: 10px;
        }
        .hero p {
            font-size: 18px;
            opacity: 0.95;
        }

        /* CONTAINER */
        .container {
            max-width: 1100px;
            margin: -50px auto 50px;
            background: white;
            padding: 45px;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        }

        .section {
            margin-bottom: 45px;
        }

        .section h2 {
            font-size: 26px;
            margin-bottom: 15px;
            color: #ff7a00;
        }

        .section p {
            line-height: 1.9;
            font-size: 15px;
            margin-bottom: 10px;
        }

        /* GRID CARD */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .card {
            padding: 25px;
            border-radius: 14px;
            background: #fafafa;
            border-left: 6px solid #ff9800;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }

        .card h3 {
            margin-top: 0;
            font-size: 18px;
        }

        /* VISI MISI */
        .visi-misi {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px,1fr));
            gap: 30px;
        }

        .box {
            background: #fff7f0;
            padding: 25px;
            border-radius: 14px;
            border: 1px solid #ffd8b5;
        }

        /* BUTTON */
        .back {
            display: inline-block;
            margin-top: 40px;
            background: #ff9800;
            color: white;
            padding: 12px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
        }
        .back:hover {
            background: #ff7a00;
        }

        @media (max-width: 600px) {
            .hero h1 { font-size: 34px; }
        }
    </style>
</head>
<body>

<!-- HERO -->
<section class="hero">
    <h1>Tentang Axera Motor</h1>
    <p>Bengkel Motor Modern & Terpercaya di Surabaya</p>
</section>

<div class="container">

    <!-- PROFIL TOKO -->
    <div class="section">
        <h2>Profil Bengkel</h2>
        <p>
            <b>Axera Motor</b> adalah bengkel servis dan penyedia sparepart motor yang berlokasi di
            <b>Surabaya</b>. Kami melayani berbagai kebutuhan perawatan sepeda motor, mulai dari servis ringan,
            servis berkala, hingga penggantian sparepart.
        </p>
        <p>
            Dengan dukungan mekanik berpengalaman dan sistem pelayanan berbasis digital,
            Axera Motor berkomitmen memberikan layanan yang <b>profesional, transparan, cepat, dan terpercaya</b>.
        </p>
    </div>

    <!-- KEUNGGULAN -->
    <div class="section">
        <h2>Keunggulan Kami</h2>

        <div class="grid">
            <div class="card">
                <h3>🔧 Mekanik Berpengalaman</h3>
                <p>Ditangani oleh tenaga ahli yang berpengalaman dan memahami berbagai jenis motor.</p>
            </div>

            <div class="card">
                <h3>🛠️ Sparepart Berkualitas</h3>
                <p>Menyediakan sparepart original dan aftermarket pilihan dengan kualitas terjamin.</p>
            </div>

            <div class="card">
                <h3>📅 Booking Servis Online</h3>
                <p>Pelanggan dapat melakukan booking servis secara online tanpa harus antre.</p>
            </div>

            <div class="card">
                <h3>💳 Pembayaran Lengkap</h3>
                <p>Mendukung pembayaran tunai, transfer bank, dan QRIS.</p>
            </div>
        </div>
    </div>

    <!-- VISI MISI -->
    <div class="section">
        <h2>Visi & Misi</h2>

        <div class="visi-misi">
            <div class="box">
                <h3>🎯 Visi</h3>
                <p>
                    Menjadi bengkel motor terpercaya dan pilihan utama masyarakat Surabaya
                    dengan pelayanan berkualitas dan teknologi modern.
                </p>
            </div>

            <div class="box">
                <h3>📌 Misi</h3>
                <ul style="padding-left: 18px; line-height: 1.8;">
                    <li>Memberikan pelayanan servis motor yang profesional dan jujur</li>
                    <li>Menyediakan sparepart berkualitas dengan harga terjangkau</li>
                    <li>Mengutamakan kenyamanan dan kepuasan pelanggan</li>
                    <li>Mengembangkan sistem layanan berbasis digital</li>
                </ul>
            </div>
        </div>
    </div>

    <a href="{{ route('home') }}" class="back">⬅ Kembali ke Home</a>
</div>

</body>
</html>
