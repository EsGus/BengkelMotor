<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Payment</title>

    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 95%;
            max-width: 900px;
            margin: 20px auto;
        }

        /* HEADER – Sesuai UI Sebelumnya */
        .header {
            display: flex;
            align-items: center;
            background: linear-gradient(to right, #ff8a00, #ff5f00);
            padding: 20px;
            border-radius: 12px;
            color: #fff;
            margin-bottom: 20px;
        }

        .back-btn {
            font-size: 20px;
            margin-right: 15px;
            cursor: pointer;
            background: #ffffffcc;
            padding: 6px 12px;
            border-radius: 8px;
            color: #333;
            text-decoration: none; /* Tambahan agar tidak ada garis bawah */
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        /* PRODUK CARD */
        .product-card {
            display: flex;
            gap: 15px;
            background: #ffffff;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
        }

        .product-card img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* SUMMARY */
        .summary-box {
            background: #ffffff;
            padding: 18px;
            border-radius: 12px;
            margin-top: 20px;
            box-shadow: 0px 3px 10px rgba(0,0,0,0.12);
        }

        .btn-bayar {
            width: 100%;
            background: linear-gradient(45deg, #ff8a00, #ff5e00);
            padding: 12px;
            border: none;
            border-radius: 8px;
            color: #fff;
            cursor: pointer;
            font-size: 17px;
            margin-top: 15px;
            font-weight: bold;
        }

        .btn-bayar:hover {
            background: linear-gradient(45deg, #ff6f00, #ff4500);
        }

        /* RESPONSIVE */
        @media (max-width: 600px) {
            .product-card {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }

            .product-card img {
                width: 140px;
                height: 140px;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- HEADER sesuai tampilan sebelumnya -->
        <div class="header">
            <a href="{{ route('payment.method') }}" class="back-btn">←</a>
            <div>
                <div class="logo">🛵 AXERA MOTOR</div>
                <small>Bengkel Servis Motor</small>
            </div>
        </div>

        <h3 style="margin-bottom: 15px;">Rincian Pesanan ({{ count($items) }})</h3>

        <!-- LIST PRODUK -->
        @foreach ($items as $item)
            <div class="product-card">
                <!-- Gunakan asset() untuk gambar agar path benar -->
                <img src="{{ asset('img/' . ($item['image'] ?? 'no-image.jpg')) }}" alt="Produk">

                <div style="flex:1;">
                    <b style="font-size: 17px;">{{ $item['nama'] }}</b><br>
                    
                    {{-- PERBAIKAN: Cek apakah key 'detail' ada, jika tidak, tampilkan string kosong atau strip --}}
                    <small style="color: #666;">{{ $item['detail'] ?? '-' }}</small><br><br>

                    <div style="color:#333;">
                        Harga: <b>Rp {{ number_format($item['harga'], 0, ',', '.') }}</b><br>
                        Qty: {{ $item['qty'] }}
                    </div>

                    @if(isset($item['layanan']))
                        <p style="margin-top:10px; color:#444;">
                            + {{ $item['layanan'] }}  
                            (Rp {{ number_format($item['biaya_layanan'], 0, ',', '.') }})
                        </p>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- SUMMARY -->
        <div class="summary-box">
            <h3>Ringkasan Pembayaran</h3>
            <p style="color:#666;">Metode Pembayaran: <strong>{{ strtoupper(session('payment_method', '-')) }}</strong></p>
            <p style="color:#666;">Total Keseluruhan</p>
            <h1 style="margin-top:-5px; color: #d32f2f;">Rp {{ number_format($total, 0, ',', '.') }}</h1>

            <form action="{{ route('payment.process') }}" method="POST">
                @csrf
                <button class="btn-bayar">Bayar Sekarang</button>
            </form>
        </div>

    </div>

</body>
</html>