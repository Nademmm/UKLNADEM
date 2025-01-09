<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Nusantara - Jawa Timur</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        footer {
            background: black;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-top: 100px;
            transition: background 0.3s ease;
            width: auto;
        }
        </style>
</head>
<body>
    <header>
        <div class="container">
            <img src="2.jpg" alt="Logo My Nusantara" class="logo">
            <a href="login.php" class="cta-button" >Login</a>
        </div>
    </header>

    <main>
        <section id="home" class="hero">
            <h2>Selamat Datang di My Nusantara - Jawa Timur</h2>
            <p>Jelajahi kekayaan budaya dari seluruh daerah di Indonesia, khususnya Jawa Timur.</p>
        </section>

        <section id="eksplorasi">
            <h3>Eksplorasi Budaya</h3>
            <p>Dengan map yang interaktif di bawah ini!</p>
            <div id="map" class="map-container"></div>
        </section>

        <section id="permainan">
            <h3>Permainan Tradisional</h3>
            <p>Permainan Tradisional Jawa Timur memiliki berbagai permainan yang kaya akan budaya dan nilai-nilai lokal. Beberapa permainan tersebut antara lain: <br>

            -Lompat Tali: Permainan ini melibatkan seutas tali yang diputar dan pemain melompat melewatinya. <br>
            -Gasing: Permainan ini melibatkan sebuah gasing yang diputar. Gasing terbuat dari kayu dan dimainkan dengan cara memutarnya agar berputar dalam waktu yang lama. <br>
            -Bola Bekel: Permainan tradisional yang melibatkan bola kecil dan beberapa biji bekel yang dilempar dan ditangkap. <br>
            </p>
        </section>

        <section id="bahasa">
            <h3>Pengetahuan Bahasa Daerah</h3>
            <p>Bahasa daerah di Jawa Timur adalah Bahasa Jawa. Berikut beberapa contoh kosakata:</p>
            <ul>
                <li>Sugeng Rawuh - Selamat Datang</li>
                <li>Matur Nuwun - Terima Kasih</li>
                <li>Salam - Salam</li>
            </ul>
        </section>

        <section id="kalender">
            <h3>Kalender Acara Budaya</h3>
            <p>Berikut adalah kalender acara budaya di Jawa Timur:</p>
            <table>
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Tanggal</th>
                        <th>Acara</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Januari</td>
                        <td style="background-color: #b7980f; color: white;">20</td>
                        <td>Festival Budaya Jawa Timur</td>
                    </tr>
                    <tr>
                        <td>Februari</td>
                        <td>25</td>
                        <td>Hari Jadi Kota Surabaya</td>
                    </tr>
                    <tr>
                        <td>Maret</td>
                        <td style="background-color: #b7980f; color: white;">15</td>
                        <td>Pameran Seni Rupa</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 My Nusantara. Semua hak dilindungi.</p>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="https://wa.me/qr/2753RE3RT7NXK1">Kontak</a></li>
                <li><a href ="About.php">About us</a></li>
            </ul>
        </div>
    </footer>
    <script src="map.js"></script>
    <script>
        function translate() {
            const input = document.getElementById('translateInput').value.trim();
            let translation = "";
            if (input === "Sugeng Rawuh") {
                translation = "Selamat Datang";
            } else if (input === "Matur Nuwun") {
                translation = "Terima Kasih";
            } else {
                translation = "Tidak ada terjemahan.";
            }
            document.getElementById('translationResult').innerText = translation;
        }
    </script>
</body>
</html>