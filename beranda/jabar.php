<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Nusantara - Jawa Barat</title>
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
            <h2>Selamat Datang di My Nusantara</h2>
            <p>Jelajahi kekayaan budaya dari seluruh daerah di Indonesia.</p>
        </section>

        <section id="eksplorasi">
            <h3>Eksplorasi Budaya </h3>
            <p>Dengan map yang interaktif di bawah ini!</p>
            <div id="map" class="map-container"></div>
        </section>

        <section id="permainan">
            <h3>Permainan Tradisional</h3>
            <p>Permainan Tradisional 
                Jawa Barat memiliki berbagai permainan tradisional yang kaya akan budaya dan nilai-nilai lokal. Beberapa permainan tersebut antara lain: <br>

-Gasing: Permainan ini melibatkan sebuah gasing yang diputar. Gasing terbuat dari kayu atau bahan lainnya dan dimainkan dengan cara memutarnya agar berputar dalam waktu yang lama. <br>
-Engklek: Permainan ini dimainkan di atas tanah dengan menggambar kotak-kotak, dan pemain melompat dari satu kotak ke kotak lainnya. <br>
-Sega: Permainan tradisional yang melibatkan kekuatan fisik dan strategi, sering dimainkan di lapangan terbuka. <br>
            </p>
        </section>

        <section id="bahasa">
            <h3>Pengetahuan Bahasa Daerah</h3>
            <p>Bahasa daerah di Jawa Barat adalah Bahasa Sunda. Berikut beberapa contoh kosakata:</p>
            <ul>
                <li>Wilujeng Sumping - Selamat Datang</li>
                <li>Hatur Nuhun - Terima Kasih</li>
                <li>Salam - Salam</li>
            </ul>
        </section>

<section id="kalender">
    <h3>Kalender Acara Budaya</h3>
    <p>Berikut adalah kalender acara budaya di Jawa Barat:</p>
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
                <td style="background-color: #b7980f; color: white;">15</td>
                <td>Festival Budaya Sunda</td>
            </tr>
            <tr>
                <td>Februari</td>
                <td>20</td>
                <td>Hari Jadi Kota Bandung</td>
            </tr>
            <tr>
                <td>Maret</td>
                <td style="background-color: #b7980f; color: white;">10</td>
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