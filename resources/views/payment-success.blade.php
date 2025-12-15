<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil | Axera Motor</title>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f4f7f6; /* Warna background lembut */
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08); /* Shadow halus */
            text-align: center;
            animation: slideUp 0.6s ease-out;
            position: relative;
            overflow: hidden;
            margin: 20px;
        }

        /* Garis Aksen Oranye di Atas */
        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, #ff8a00, #ff5f00);
        }

        /* Lingkaran Ikon */
        .icon-circle {
            width: 90px;
            height: 90px;
            background-color: #e3f9da; /* Hijau Sangat Muda */
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 25px;
            animation: bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        /* Ikon Centang SVG */
        .checkmark {
            width: 45px;
            height: 45px;
            fill: none;
            stroke: #28a745;
            stroke-width: 4;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 50;
            stroke-dashoffset: 50;
            animation: drawCheck 0.5s 0.6s forwards; /* Animasi menggambar centang */
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        p {
            color: #777;
            font-size: 15px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        /* Kotak Info Kecil */
        .status-badge {
            background: #f9f9f9;
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 13px;
            color: #666;
            margin-bottom: 25px;
            display: inline-block;
            border: 1px dashed #ddd;
            font-weight: 500;
        }

        /* Tombol Modern */
        .btn-home {
            display: block;
            width: 100%;
            background: linear-gradient(to right, #ff8a00, #ff5f00);
            color: #ffffff;
            text-decoration: none;
            padding: 15px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 10px 20px rgba(255, 95, 0, 0.2);
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(255, 95, 0, 0.3);
        }

        /* Keyframes Animasi */
        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes bounceIn {
            0% { transform: scale(0); }
            60% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes drawCheck {
            to { stroke-dashoffset: 0; }
        }
    </style>
</head>
<body>

    <div class="container">
        
        <!-- Animasi Ikon -->
        <div class="icon-circle">
            <svg class="checkmark" viewBox="0 0 24 24">
                <path d="M20 6L9 17l-5-5"></path>
            </svg>
        </div>

        <h1>Pembayaran Sukses!</h1>
        
        <div class="status-badge">
            Transaksi Berhasil Diproses
        </div>

        <p>
            Terima kasih telah berbelanja di <strong>AXERA MOTOR</strong>. <br>
            Pesanan Anda telah kami terima dan akan segera dipersiapkan.
        </p>

        <a href="{{ route('home') }}" class="btn-home">Kembali ke Beranda</a>
    </div>

</body>
</html>