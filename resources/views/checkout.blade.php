<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - AXERA MOTOR</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #1e88e5;
            color: white;
        }

        h1 {
            margin-bottom: 20px;
        }

        .total {
            margin-top: 15px;
            font-size: 1.3em;
            font-weight: bold;
            text-align: right;
        }

        .btn {
            background: #1e88e5;
            color: white;
            padding: 10px 18px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 16px;
        }

        .btn:hover {
            background: #0d6efd;
        }

        .method-box {
            background: #fff;
            padding: 20px;
            margin-top: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <h1>🧾 Checkout Pembelian</h1>

    <table>
        <tr>
            <th>ID Produk</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>

        @foreach($cart as $item)
        <tr>
            <td>{{ $item->id_produk }}</td>
            <td>{{ $item->qty }}</td>
            <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="total">
        Total: Rp{{ number_format($total, 0, ',', '.') }}
    </div>

    <div class="method-box">
        <h3>Pilih Metode Pembayaran</h3>

        <form action="{{ route('checkout.proses') }}" method="POST">
            @csrf

            <label>
                <input type="radio" name="metode_pembayaran" value="Transfer Bank" required>
                Transfer Bank
            </label><br>

            <label>
                <input type="radio" name="metode_pembayaran" value="Dana">
                DANA
            </label><br>

            <label>
                <input type="radio" name="metode_pembayaran" value="OVO">
                OVO
            </label><br>

            <label>
                <input type="radio" name="metode_pembayaran" value="GoPay">
                GoPay
            </label><br>

            <label>
                <input type="radio" name="metode_pembayaran" value="COD">
                Bayar di Tempat (COD)
            </label>

            <button type="submit" class="btn">Konfirmasi & Bayar</button>
        </form>
    </div>

</body>

</html>