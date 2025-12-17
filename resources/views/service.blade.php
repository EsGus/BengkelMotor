<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Service - AXERA MOTOR</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            background: linear-gradient(180deg, #111827, #1f2933);
            min-height: 100vh;
        }

        /* HEADER */
        header {
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.08);
            color: white;
            padding: 16px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .back-btn {
            color: #ffb703;
            text-decoration: none;
            font-weight: 600;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 46px;
            filter: drop-shadow(0 0 5px rgba(255,255,255,.3));
        }

        .judul h2 {
            margin: 0;
            font-size: 18px;
        }

        .judul p {
            margin: 0;
            font-size: 12px;
            opacity: .8;
        }

        .header-right {
            text-align: right;
            font-size: 13px;
        }

        .logout {
            color: #ff6b6b;
            text-decoration: none;
            font-weight: 600;
        }

        /* MAIN */
        main {
            display: flex;
            justify-content: center;
            padding: 50px 16px;
        }

        .form-container {
            width: 100%;
            max-width: 520px;
            background: white;
            padding: 32px;
            border-radius: 18px;
            box-shadow: 0 25px 50px rgba(0,0,0,.35);
            animation: fadeUp .6s ease;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-container h3 {
            text-align: center;
            margin-bottom: 28px;
            font-size: 20px;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            margin-bottom: 18px;
            transition: .2s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #ff8a00;
            box-shadow: 0 0 0 3px rgba(255,138,0,.15);
        }

        .jam {
            display: flex;
            gap: 12px;
        }

        .submit-btn {
            margin-top: 10px;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #ff8a00, #ff5f00);
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(255,138,0,.45);
        }

        .submit-btn:hover {
            transform: translateY(-1px);
        }

        /* NOTIF */
        .notif {
            position: fixed;
            top: 25px;
            right: 25px;
            background: #16a34a;
            color: white;
            padding: 14px 22px;
            border-radius: 12px;
            opacity: 0;
            transform: translateY(-10px);
            transition: .3s;
            z-index: 999;
            box-shadow: 0 10px 30px rgba(0,0,0,.3);
        }

        .notif.show {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 600px) {
            header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }
    </style>
</head>

<body>

<header>
    <a href="{{ route('home') }}" class="back-btn">⬅ Kembali</a>

    <div class="header-left">
        <img src="{{ asset('img/bike.png') }}" class="logo-icon">
        <div class="judul">
            <h2>AXERA MOTOR</h2>
            <p>Bengkel Servis Motor</p>
        </div>
    </div>

    <div class="header-right">
        <div>Kasir</div>
        <a href="login.html" class="logout">Log out</a>
    </div>
</header>

<main>
    <div class="form-container">
        <h3>🛠️ Pendaftaran Servis</h3>

        <form id="serviceForm">
            <label>Nama</label>
            <input type="text" required>

            <label>No Handphone</label>
            <input type="tel" required>

            <label>Nomor Polisi Kendaraan</label>
            <input type="text" required>

            <label>Tipe Motor</label>
            <input type="text" required>

            <label>Tanggal Servis</label>
            <input type="date" required>

            <label>Jam Servis</label>
            <div class="jam">
                <select required>
                    <option value="">Jam</option>
                    <option>08</option><option>09</option><option>10</option>
                    <option>11</option><option>12</option><option>13</option>
                    <option>14</option><option>15</option>
                </select>
                <select required>
                    <option value="">Menit</option>
                    <option>00</option><option>15</option>
                    <option>30</option><option>45</option>
                </select>
            </div>

            <label>Keluhan (Opsional)</label>
            <input type="text">

            <button class="submit-btn">Kirim 📤</button>
        </form>
    </div>
</main>

<div id="notif" class="notif">
    ✅ Pendaftaran servis berhasil dikirim!
</div>

<script>
    const form = document.getElementById('serviceForm');
    const notif = document.getElementById('notif');

    form.addEventListener('submit', e => {
        e.preventDefault();
        notif.classList.add('show');
        setTimeout(() => notif.classList.remove('show'), 3000);
        form.reset();
    });
</script>

</body>
</html>
