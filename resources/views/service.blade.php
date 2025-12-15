<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Service - AXERA MOTOR</title>
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
</head>
<body>

    <header>
        <!-- Tombol kembali sesuai template kamu -->
        <div class="back-container">
            <a href="{{ route('home') }}" class="back-btn">⬅ Kembali</a>
        </div>

        <div class="header-left">
            <img src="{{ asset('img/bike.png') }}" alt="Logo Motor" class="logo-icon">
            <div class="judul">
                <h2>AXERA MOTOR</h2>
                <p>Bengkel Servis Motor</p>
            </div>
        </div>

        <div class="header-right">
            <p class="role">Kasir</p>
            <a href="login.html" class="logout">Log out</a>
        </div>
    </header>

    <main>

        <div class="form-container">
            <h3>Form berikut untuk melakukan service ya!</h3>
            <form id="serviceForm">
                <label>Nama</label>
                <input type="text" required>

                <label>No Handphone</label>
                <input type="tel" required>

                <label>Nomor Polisi Kendaraan</label>
                <input type="text" required>

                <label>Type Motor Anda</label>
                <input type="text" required>

                <label>Tgl Rencana Servis</label>
                <input type="date" required>

                <label>Rencana Jam Servis</label>
                <div class="jam">
                    <select required>
                        <option value="">Jam</option>
                        <option>08</option>
                        <option>09</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                    </select>
                    <select required>
                        <option value="">Menit</option>
                        <option>00</option>
                        <option>15</option>
                        <option>30</option>
                        <option>45</option>
                    </select>
                </div>

                <label>Keluhan Anda? (Jika ada)</label>
                <input type="text">

                <button type="submit" class="submit-btn">
                    Kirim <span>📤</span>
                </button>
            </form>
        </div>
    </main>

    <div id="notif" class="notif">
        ✅ Pendaftaran berhasil dikirim!
    </div>

    <script>
        const form = document.getElementById('serviceForm');
        const notif = document.getElementById('notif');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            notif.classList.add('show');

            setTimeout(() => {
                notif.classList.remove('show');
            }, 3000);

            form.reset();
        });
    </script>

</body>
</html>
