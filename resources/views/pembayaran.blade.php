<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - AXERA MOTOR</title>
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
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        th, td {
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
    </style>
</head>
<body>
    <h1>💰 Pembayaran</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <table>
        <tr>
            <th>ID Produk</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
        @foreach($details as $item)
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
</body>
</html>
