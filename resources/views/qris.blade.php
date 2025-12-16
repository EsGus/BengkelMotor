<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran QRIS</title>

    <style>
        body {
            background: #f4f4f4;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
        }

        .container {
            max-width: 900px;
            width: 95%;
            margin: 25px auto;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 15px;
            background: linear-gradient(to right, #ff9b00, #ff6a00);
            padding: 15px 20px;
            border-radius: 12px;
            color: #fff;
        }

        .back-btn {
            font-size: 22px;
            background: #fff;
            color: #333;
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
        }

        .card {
            background: #fff;
            margin-top: 20px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.12);
            text-align: center;
        }

        .total {
            font-size: 26px;
            font-weight: bold;
            color: #d32f2f;
            margin-bottom: 15px;
        }

        .qris-img {
            width: 260px;
            margin: 15px auto;
        }

        .btn-confirm {
            width: 100%;
            margin-top: 20px;
            background: #ff7a00;
            border: none;
            padding: 14px;
            border-radius: 10px;
            color: #fff;
            font-size: 17px;
            cursor: pointer;
            font-weight: 600;
        }

        .note {
            margin-top: 15px;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <a href="{{ route('payment.method') }}" class="back-btn">←</a>
        <div>
            <div style="font-size: 26px; font-weight: bold;">🛵 AXERA MOTOR</div>
            <small>Bengkel Servis Motor</small>
        </div>
    </div>

    <div class="card">
        <h2>Scan QRIS untuk Membayar</h2>

        <div class="total">
            Rp {{ number_format($total, 0, ',', '.') }}
        </div>

        <img src="{{ asset('img/qris.png') }}" class="qris-img" alt="QRIS">

        <form action="{{ route('payment.process') }}" method="POST">
            @csrf
            <input type="hidden" name="method" value="qris">
            <button class="btn-confirm">Saya Sudah Bayar</button>
        </form>

        <div class="note">
            * Pembayaran akan diverifikasi oleh admin
        </div>
    </div>

</div>

</body>
</html>
