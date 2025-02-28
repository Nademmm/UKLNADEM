<?php
    session_start();
    include 'connect.php';

    $query = "SELECT * FROM acara;";
    $sql = mysqli_query($conn, $query);
    $no = 0;
    $loggedInUser  = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : null;

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Nusantara</title>
<link rel="stylesheet" href="/MY_NUSANTARA/css/index.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
    <header>
        <div class="container">
<img src="/MY_NUSANTARA/image/2.jpg" alt="Logo My Nusantara" class="logo">

            <?php if ($loggedInUser ): ?>
                <!-- Tampilkan nama pengguna jika sudah login -->
                <a href="dasbor.php" class="cta-button"><?php echo htmlspecialchars($loggedInUser ); ?></a>
            <?php else: ?>
                <!-- Tampilkan tombol Login jika belum login -->
                <a href="login.php" id="loginButton" class="cta-button">Login</a>
            <?php endif; ?>
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

        <section id="budaya" class="culture-section">
            <img src="/MY_NUSANTARA/image/3.jpg" alt="Budaya Indonesia" class="culture-image">
            <p>Budaya Indonesia adalah sebuah simfoni megah yang mengalun dari ujung barat hingga timur, sebuah harmoni yang dihasilkan dari interaksi antara beragam suku, agama, dan tradisi yang telah terjalin selama ribuan tahun. Bayangkan sebuah lukisan raksasa yang penuh warna, di mana setiap daerah menambahkan warna dan motifnya sendiri, menciptakan sebuah mozaik budaya yang kaya dan menawan. Setiap suku bangsa di Indonesia menyimpan kisah-kisah unik yang membentuk identitas mereka, menjadikan setiap langkah di tanah air ini sebagai perjalanan yang penuh makna.</p>

            <p>Di tengah kekayaan budaya ini, seni berdiri sebagai jiwa yang bergetar. Ia bukan hanya sekadar karya yang dilihat, tetapi sebuah ungkapan perasaan yang mendalam. Seni rupa, dengan segala keindahan dan kerumitannya, adalah cermin dari jiwa masyarakat, menceritakan kisah-kisah yang terukir dalam setiap goresan dan warna. Seni pertunjukan, seperti tarian dan teater, menghidupkan cerita-cerita kuno, membawa penonton melintasi waktu dan ruang, merasakan denyut nadi budaya yang telah ada sejak zaman purba.</p>

            <p>Bahasa, sebagai alat komunikasi, juga memiliki keajaiban tersendiri. Dengan lebih dari 700 bahasa yang dituturkan di seluruh nusantara, setiap bahasa adalah jendela menuju dunia yang berbeda. Setiap kata dan ungkapan bukan hanya sekadar simbol, tetapi juga membawa makna yang mendalam, mencerminkan cara pandang masyarakat terhadap alam dan kehidupan. Dalam bahasa-bahasa ini, tersimpan sejarah, tradisi, dan nilai-nilai yang telah terjalin dalam setiap interaksi manusia.</p>

            <p>Adat istiadat dan tradisi adalah jalinan yang memperkuat ikatan sosial, menciptakan rasa kebersamaan yang tak tergantikan. Setiap suku memiliki ritual dan kebiasaan yang diwariskan dari generasi ke generasi, menjadi jembatan antara yang lalu dan yang kini. Dari cara berpakaian yang mencolok hingga hidangan khas yang menggugah selera, setiap elemen budaya ini adalah perayaan kehidupan, yang menghidupkan semangat dan kebahagiaan di antara anggota masyarakat. Tradisi bukan sekadar rutinitas; mereka adalah momen magis yang menghubungkan kita dengan akar dan identitas kita.</p>

            <p>Sistem kepercayaan di Indonesia menambahkan lapisan keindahan yang lain dalam budaya yang kaya ini. Dengan beragam agama dan kepercayaan yang dianut, masyarakat Indonesia menciptakan lingkungan yang penuh toleransi dan saling menghormati. Upacara keagamaan dan perayaan menjadi panggung di mana elemen budaya lokal dan praktik spiritual berpadu, menciptakan harmoni yang menakjubkan antara tradisi dan keyakinan.</p>

            <p>Secara kesel uruhan, budaya Indonesia adalah sebuah perjalanan yang dinamis dan menawan, sebuah cerita yang terus berkembang. Ia bukan hanya sekadar identitas, tetapi juga warisan yang harus dijaga dan dihargai. Dengan memahami dan merayakan keragaman budaya ini, kita tidak hanya menghargai perbedaan, tetapi juga memperkuat persatuan dalam masyarakat yang multikultural. Mari kita eksplorasi dan nikmati keindahan budaya Indonesia, karena di dalamnya terdapat kekayaan yang tak ternilai, menunggu untuk ditemukan, dipelajari, dan dirayakan oleh setiap generasi yang akan datang.</p>
        </section>
    
        <section id="shop" class="logo">
            <h3>Belanja</h3>
            <p class="item-tradisional">Item tradisional yang tersedia</p>
            <div class="item-container">
                <div class="item-box">
                    <img src="/MY_NUSANTARA/image/blangkon.jpg" alt="Item 1" class="item-image">
                    <p class="item-title">Blangkon</p>
                    <p class="item-price">Harga: Rp 65.000</p>
                    <a href="https://tokopedia.link/snlDCwCXWOb" class="buy-button">Beli</a>
                </div>
                <div class="item-box">
                    <img src="/MY_NUSANTARA/image/batik.jpg" alt="Item 2" class="item-image2">
                    <p class="item-title">Baju Batik</p>
                    <p class="item-price">Harga: Rp 195.000</p>
                    <a href="https://tokopedia.link/IRbOYPKXWOb" class="buy-button">Beli</a>
                </div>
                <div class="item-box">
                    <img src="/MY_NUSANTARA/image/lurik.jpg" alt="Item 3" class="item-image">
                    <p class="item-title">Baju Lurik</p>
                    <p class="item-price">Harga: Rp 79.000</p>
                    <a href="https://tokopedia.link/px2ejSPXWOb" class="buy-button">Beli</a>
                </div>
                <div class="item-box">
                    <img src="/MY_NUSANTARA/image/topeng.png" alt="Item 4" class="item-image">
                    <p class="item-title">Topeng Bali</p>
                    <p class="item-price">Harga: Rp 700.000</p>
                    <a href="https://tokopedia.link/QrLwhY4XWOb" class="buy-button">Beli</a>
                </div>
            </div>
        </section>
        
    </main>
    <footer style=margin-top:600px;>
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
