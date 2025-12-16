<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transfer Bank</title>

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
        }

        .bank-box {
            background: #fff5e6;
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
        }

        .total {
            font-size: 26px;
            font-weight: bold;
            color: #d32f2f;
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
        <h2>Transfer Bank</h2>

        <p>Total Pembayaran:</p>
        <div class="total">
            Rp {{ number_format($total, 0, ',', '.') }}
        </div>

        <div class="bank-box">
            <b>BCA</b><br>
            1234567890<br>
            a.n AXERA MOTOR
        </div>

        <div class="bank-box">
            <b>BRI</b><br>
            9876543210<br>
            a.n AXERA MOTOR
        </div>

        <form action="{{ route('payment.process') }}" method="POST">
            @csrf
            <input type="hidden" name="method" value="transfer">
            <button class="btn-confirm">Saya Sudah Transfer</button>
        </form>
    </div>

</div>

</body>
</html>
