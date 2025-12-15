<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Metode Pembayaran</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">

    <style>
        body {
            background: #f4f4f4;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            width: 95%;
            margin: 25px auto;
        }

        /* HEADER */
        .header {
            display: flex;
            align-items: center;
            gap: 15px;
            background: linear-gradient(to right, #ff9b00, #ff6a00);
            padding: 15px 20px;
            border-radius: 12px;
            color: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .back-btn {
            font-size: 22px;
            background: #fff;
            color: #333;
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .title {
            margin-top: 25px;
            font-size: 22px;
            color: #333;
            font-weight: bold;
        }

        /* PAYMENT METHOD CARD */
        .method-card {
            background: #fff;
            border-radius: 12px;
            padding: 18px;
            margin-top: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: .25s;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .method-card:hover {
            border-color: #ff8a00;
        }

        .method-card.selected {
            border-color: #ff7a00;
            background: #fff5e6;
        }

        .method-card img {
            width: 48px;
            height: 48px;
        }

        .method-text {
            font-size: 17px;
            color: #333;
        }

        input[type=radio] {
            transform: scale(1.3);
        }

        /* SUMMARY */
        .summary-box {
            margin-top: 25px;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.12);
        }

        .sum-total {
            font-size: 28px;
            font-weight: bold;
        }

        /* BUTTON */
        .btn-next {
            width: 100%;
            margin-top: 20px;
            background: #ff7a00;
            border: none;
            padding: 14px;
            border-radius: 10px;
            color: #fff;
            font-size: 17px;
            cursor: pointer;
            transition: .25s;
            font-weight: 600;
        }

        .btn-next:hover {
            background: #ff5500;
            transform: translateY(-2px);
            box-shadow: 0 5px 14px rgba(255,115,0,0.45);
        }
    </style>

    <script>
        // highlight card saat dipilih
        function selectCard(el) {
            document.querySelectorAll('.method-card').forEach(card => {
                card.classList.remove('selected');
            });

            el.classList.add('selected');
            el.querySelector('input[type=radio]').checked = true;
        }
    </script>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="back-btn" onclick="history.back()">←</div>
        <div>
            <div style="font-size: 26px; font-weight: bold;">🛵 AXERA MOTOR</div>
            <small>Bengkel Servis Motor</small>
        </div>
    </div>

    <!-- TITLE -->
    <div class="title">Pilih Metode Pembayaran</div>

    <!-- SUMMARY -->
    <div class="summary-box">
        <div>Total Pembayaran:</div>
        <div class="sum-total">Rp {{ number_format($total) }}</div>
    </div>

    <!-- FORM -->
    <form action="{{ route('choose.payment.method') }}" method="POST">
        @csrf

    <div class="method-card" onclick="selectCard(this)">
    <input type="radio" name="method" value="cash" required>

    <!-- ICON CASH (SVG) -->
    <svg width="45" height="45" viewBox="0 0 24 24" fill="#28a745">
        <path d="M2 7h20v10H2V7zm3 2a2 2 0 0 1-2-2v8a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2V7a2 2 0 0 1-2 2H5zm7 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
    </svg>

    <div class="method-text">Bayar Cash</div>
</div>


    <div class="method-card" onclick="selectCard(this)">
    <input type="radio" name="method" value="qris">

    <!-- ICON QRIS (QR SVG) -->
    <svg width="45" height="45" viewBox="0 0 24 24" fill="#000">
        <path d="M3 3h6v6H3V3zm2 2v2h2V5H5zm10-2h6v6h-6V3zm2 2v2h2V5h-2zM3 15h6v6H3v-6zm2 2v2h2v-2H5zm12-2h2v2h-2v-2zm0 4h4v2h-4v-2zm-4-4h2v6h-2v-6z"/>
    </svg>

    <div class="method-text">QRIS</div>
</div>

<div class="method-card" onclick="selectCard(this)">
    <input type="radio" name="method" value="transfer">

    <!-- ICON BANK (SVG) -->
    <svg width="45" height="45" viewBox="0 0 24 24" fill="#007bff">
        <path d="M12 2 1 7l11 5 11-5-11-5zm-9 9v8h4v-8H3zm6 0v8h6v-8H9zm8 0v8h4v-8h-4z"/>
    </svg>

    <div class="method-text">Transfer Bank</div>
</div>


        <button class="btn-next">Lanjut Bayar</button>
    </form>

</div>

</body>
</html>