<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Karir - Axera Motor</title>
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
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px,1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background: #fafafa;
            padding: 25px;
            border-radius: 12px;
            border-left: 5px solid #ff9800;
        }
        ul {
            padding-left: 20px;
        }
        ul li {
            margin-bottom: 8px;
        }
        .apply-box {
            background: #e8f5e9;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #28a745;
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
    <h1>Karir di Axera Motor</h1>
    <p>Berkembang Bersama Bengkel Motor Modern di Surabaya</p>
</section>

<div class="container">

    <div class="section">
        <h2>🚀 Bergabung Bersama Kami</h2>
        <p>
            <b>Axera Motor</b> membuka kesempatan bagi Anda yang ingin berkembang
            di dunia otomotif. Kami percaya bahwa tim yang solid adalah kunci
            pelayanan bengkel yang berkualitas dan profesional.
        </p>
    </div>

    <div class="section">
        <h2>💼 Lowongan Tersedia</h2>
        <div class="grid">

            <div class="card">
                <h3>🔧 Mekanik Motor</h3>
                <b>Kualifikasi:</b>
                <ul>
                    <li>Pria, usia 18–35 tahun</li>
                    <li>Pengalaman servis motor (diutamakan)</li>
                    <li>Menguasai servis ringan & berat</li>
                    <li>Jujur, disiplin, dan bertanggung jawab</li>
                </ul>
            </div>

            <div class="card">
                <h3>🧾 Admin Bengkel</h3>
                <b>Kualifikasi:</b>
                <ul>
                    <li>Wanita/Pria, minimal SMA/SMK</li>
                    <li>Mampu mengoperasikan komputer</li>
                    <li>Teliti & rapi dalam pencatatan</li>
                    <li>Komunikatif dengan pelanggan</li>
                </ul>
            </div>

            <div class="card">
                <h3>🛒 Staff Sparepart</h3>
                <b>Kualifikasi:</b>
                <ul>
                    <li>Memahami sparepart motor</li>
                    <li>Mampu melayani pelanggan</li>
                    <li>Berpengalaman di toko/bengkel</li>
                </ul>
            </div>

        </div>
    </div>

    <div class="section">
        <h2>🎯 Keuntungan Bekerja di Axera Motor</h2>
        <ul>
            <li>Gaji kompetitif & bonus kinerja</li>
            <li>Lingkungan kerja kekeluargaan</li>
            <li>Peluang belajar & pengembangan skill</li>
            <li>Kesempatan menjadi karyawan tetap</li>
        </ul>
    </div>

    <div class="section">
        <h2>📨 Cara Melamar</h2>
        <div class="apply-box">
            <p>
                Kirimkan CV dan data diri Anda ke:
            </p>
            <ul>
                <li><b>WhatsApp:</b> 08xxxxxxxxxx</li>
                <li><b>Email:</b> axeramotor@gmail.com</li>
                <li>Atau datang langsung ke bengkel Axera Motor (Surabaya)</li>
            </ul>
        </div>
    </div>

    <a href="{{ route('home') }}" class="back">⬅ Kembali ke Home</a>

</div>

</body>
</html>
