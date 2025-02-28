<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Nusantara - Jawa Tengah</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/index.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
    <header>
        <div class="container">
            <img src="/MY_NUSANTARA/image/2.jpg" alt="Logo My Nusantara" class="logo">
            <a href="login.php" class="cta-button" >Login</a>
        </div>
    </header>

    <main>
        <section id="home" class="hero">
            <h2>Selamat Datang di My Nusantara - Jawa Tengah</h2>
            <p>Jelajahi kekayaan budaya dari seluruh daerah di Indonesia, khususnya Jawa Tengah.</p>
        </section>

        <section id="eksplorasi">
            <h3>Eksplorasi Budaya</h3>
            <p>Dengan peta interaktif di bawah ini!</p>
            <div id="map" class="map-container"></div>
        </section>

        <section id="permainan">
            <h3>Permainan Tradisional</h3>
            <p>Permainan Tradisional Jawa Tengah memiliki berbagai permainan yang kaya akan budaya dan nilai-nilai lokal. Beberapa permainan tersebut antara lain: <br>

            -Bola Kasti: Permainan ini melibatkan dua tim yang berusaha memukul bola dan berlari ke base. <br>
            -Egrang: Permainan ini menggunakan alat dari bambu yang digunakan untuk berjalan tinggi. <br>
            -Kelereng: Permainan ini melibatkan bola kecil yang dimainkan dengan cara memukul dan mengumpulkan kelereng. <br>
            </p>
        </section>

        <section id="bahasa">
            <h3>Pengetahuan Bahasa Daerah</h3>
            <p>Bahasa daerah di Jawa Tengah adalah Bahasa Jawa. Berikut beberapa contoh kosakata:</p>
            <ul>
                <li>Wilujeng Sumping - Selamat Datang</li>
                <li>Maturnuwun - Terima Kasih</li>
                <li>Salam - Salam</li>
            </ul>
        </section>

        <section id="kalender">
            <h3>Kalender Acara Budaya</h3>
            <p>Berikut adalah kalender acara budaya di Jawa Tengah:</p>
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
                        <td>Maret</td>
                        <td style="background-color: #b7980f; color: white;">10</td>
                        <td>Festival Budaya Jawa Tengah</td>
                    </tr>
                    <tr>
                        <td>April</td>
                        <td>15</td>
                        <td>Hari Jadi Kota Semarang</td>
                    </tr>
                    <tr>
                        <td>Mei</td>
                        <td style="background-color: #b7980f; color: white;">20</td>
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
                <li><a href="About.php">About us</a></li>
            </ul>
        </div>
    </footer>
 <script src="map.js"></script>
</body>
</html>