<?php
    session_start();
    include 'connect.php';

    $loggedInUser = isset($_SESSION['user']) ? $_SESSION['user']['username'] : null;
    $detailAcara = null;
    if (isset($_GET['id_acara'])) {
        $id_acara = intval($_GET['id_acara']);
        $detailQuery = "SELECT * FROM acara WHERE id_acara = $id_acara LIMIT 1;";
        $detailResult = mysqli_query($conn, $detailQuery);
        if ($detailResult && mysqli_num_rows($detailResult) > 0) {
            $detailAcara = mysqli_fetch_assoc($detailResult);
        }
    } 
    $query = "SELECT * FROM acara;";
    $sql = mysqli_query($conn, $query);
?>  

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Nusantara</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Judson:wght@700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=El Messiri:wght@400;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ek Mukta:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    
</head>
<body>
    <header>
        <div class="container"> 
            <h1 class="logo">MY NUSANTARA</h1>
            <nav class="header-icons">
                <?php if ($loggedInUser): ?>
                    <a href="dasbor.php"><img src="/MY_NUSANTARA/image/image.png" alt="User" class="icon"></a>
                <?php else: ?>
                    <a href="login.php" id="loginButton"><img src="/MY_NUSANTARA/image/image.png" alt="User" class="icon"></a>
                <?php endif; ?>
                <a href="keranjang.php"><img src="/MY_NUSANTARA/image/icon.png" alt="Cart" class="icon"></a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h2>Selamat Datang di My Nusantara</h2>
            <p class="p1">Jelajahi kekayaan budaya dari seluruh daerah di Indonesia</p>
        </div>
    </section>

    <main>
        <h3>Eksplorasi Budaya</h3>
        <p class="p">Dengan map di bawah ini!</p>
        <section class="map-container">
            <div id="map" alt="Peta Budaya" class="responsive-image"></div>
        </section>

        <section class="content-section" id="penjelasan">
            <h3>Budaya Indonesia</h3>
            <p>
                Budaya Indonesia adalah sebuah sistem kompleks yang mencakup beragam aspek kehidupan, mulai dari adat istiadat, seni, bahasa, hingga kepercayaan masyarakat yang tersebar di seluruh Nusantara. Keberagaman budaya ini menjadi ciri khas Indonesia, mencerminkan sejarah panjang dan interaksi antara berbagai suku bangsa, pengaruh budaya asing, dan perkembangan lokal. <br>
                Aspek-Aspek Budaya Indonesia: 
                <br>-Adat Istiadat:
                Setiap daerah memiliki adat istiadat yang khas, seperti upacara pernikahan, upacara kematian, dan ritual keagamaan. 
                <br>-Seni dan Kesenian: 
                Seni tradisional Indonesia sangat beragam, mulai dari tarian daerah (Tari Saman, Tari Kecak, Tari Reog Ponorogo), alat musik tradisional (Angklung), hingga kerajinan tangan (batik, tenun ikat). 
                <br>-Bahasa:
                Indonesia memiliki lebih dari 700 bahasa daerah, masing-masing dengan ciri khas dan logat yang berbeda.
                <br>-Pakaian Adat:
                Pakaian adat setiap daerah memiliki makna dan filosofi tersendiri, seperti kebaya, ulos Batak, baju bodo Bugis, dan pakaian adat Madura. 
                <br>-Kuliner:
                Indonesia kaya akan kuliner khas yang mencerminkan keberagaman budaya, seperti rendang, gudeg, pempek, dan papeda. 
                <br>-Kepercayaan:
                Masyarakat Indonesia memiliki berbagai kepercayaan, baik agama mayoritas (Islam, Kristen, Hindu, Budha) maupun kepercayaan tradisional (animisme, dinamisme).
            </p>
        </section>

        <div class="divider">
            <img src="/MY_NUSANTARA/image/Rectangle12.png" alt="Ornamen Garis" class="responsive-image">
        </div>

        <section class="shopping-section" id="belanja">
            <h3>Belanja</h3>
            <div class="item-container">
                <?php
                $barangQuery = "SELECT id_barang, nama_barang, gambar_barang, harga_barang FROM barang_tradisional";
                $barangResult = mysqli_query($conn, $barangQuery);
                if ($barangResult && mysqli_num_rows($barangResult) > 0) {
                    while ($barang = mysqli_fetch_assoc($barangResult)) {
                        echo '<div class="item-box">';
                        echo '<img src="/MY_NUSANTARA/admin/uploads/' . htmlspecialchars($barang["gambar_barang"]) . '" alt="' . htmlspecialchars($barang["nama_barang"]) . '" class="item-image">';
                        echo '<p class="item-title">' . htmlspecialchars($barang["nama_barang"]) . '</p>';
                        echo '<p class="item-price">Harga: Rp ' . number_format($barang["harga_barang"], 0, ",", ".") . '</p>';
                        echo '<button class="buy-button" onclick="addToCart(\'barang\', ' . $barang["id_barang"] . ')">Beli</button>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Tidak ada barang tersedia saat ini.</p>';
                }
                ?>
            </div>
        </section><br><br>
        <script>
            function addToCart(type, id) {
                fetch('keranjang.php?add_' + type + '=' + id)
                    .then(response => {
                        if (response.ok) {
                            alert('Item berhasil ditambahkan ke keranjang.');
                        } else {
                            alert('Gagal menambahkan item ke keranjang.');
                        }
                    })
                    .catch(() => {
                        alert('Terjadi kesalahan saat menambahkan item ke keranjang.');
                    });
            }
        </script>
        
        <div class="divider">
            <img src="/MY_NUSANTARA/image/Rectangle12.png" alt="Ornamen Garis" class="responsive-image">
        </div>

        <section class="event-section" id="acara">
            <h3>Event</h3>
            <p class="p">Tiket acara kebudayaan yang akan hadir</p><br>   
            <div class="event-cards-container">
                <?php
                if ($sql && mysqli_num_rows($sql) > 0) {
                    while ($row = mysqli_fetch_assoc($sql)) {
                        echo '<div class="event-card">';
                        echo '<h3>' . htmlspecialchars($row["nama_acara"]) . '</h3>';
                        echo '<div class="event-details">';
                        echo '<p>' . htmlspecialchars($row["tempat_acara"]) . '</p>';
                        echo '<p>' . htmlspecialchars($row["tanggal_acara"]) . '</p>';
                        echo '<a href="detail_acara.php?id_acara=' . urlencode($row["id_acara"]) . '" class="buy-button">Lihat Detail</a> ';
                        echo '<button class="buy-button" onclick="addToCart(\'acara\', ' . $row["id_acara"] . ')">Beli</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Tidak ada acara yang tersedia saat ini.</p>';
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
    <div class="footer-grid">
        <div class="footer-brand">
            <h2>MY NUSANTARA</h2>
            <p>&copy; 2025 My Nusantara. Semua hak dilindungi.</p>
        </div>

        <div class="footer-links">
        <h4>Informasi</h4>
            <ul>
                <li><a href="#">Beranda</a></li>
                <li><a href="tentangkami.php">Tentang kami</a></li>
                <li><a href="dasbor.php">Tentang akun</a></li>
            </ul>
        </div>  

        <div class="footer-links">
        <h4>Layanan</h4>
            <ul>
                <li><a href="#acara">Tiket acara</a></li>
                <li><a href="#belanja">Belanja</a></li>
                <li><a href="#map">Jelajah map</a></li>
            </ul>
        </div>

        <div class="footer-links">
        <h4>Shop</h4>
            <ul>
                <li><a href="keranjang.php">Keranjang</a></li>
                <li><a href="Pesanan.php">Pesanan</a></li>
            </ul>
        </div>
    </div>
</footer>
<script src="map.js"></script>
</body>
</html>