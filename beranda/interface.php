<?php
    session_start();
    include 'connect.php';

    $loggedInUser = isset($_SESSION['user']) ? $_SESSION['user']['username'] : null;

    $region = isset($_GET['region']) ? $_GET['region'] : 'Jawa Timur';

    $query = "SELECT wc.*, w.nama_wilayah FROM wilayah_content wc JOIN wilayah w ON wc.id_wilayah = w.id_wilayah WHERE w.nama_wilayah = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $region);
    $stmt->execute();
    $result = $stmt->get_result();
    $contentData = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Nusantara - <?php echo htmlspecialchars($region); ?></title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/explor.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Judson:wght@700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=El Messiri:wght@400;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ek Mukta:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />

</head>
<body>
    <header>
        <div class="container">
            <h1 class="logo">MY NUSANTARA</h1>
            <nav class="header-icons">
                <a href="index1.php"><img src="https://indonesiakaya.com/wp-content/themes/indonesiakaya-X2/images/svg/icon__home.svg" alt="Cart" class="icon"></a>
                <?php if ($loggedInUser): ?>
                    <a href="dasbor.php"><img src="/MY_NUSANTARA/image/image.png" alt="User" class="icon" /></a>
                <?php else: ?>
                    <a href="login.php" id="loginButton"><img src="/MY_NUSANTARA/image/image.png" alt="User" class="icon" /></a>
                <?php endif; ?>
                <a href="keranjang.php"><img src="/MY_NUSANTARA/image/icon.png" alt="Cart" class="icon" /></a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h2>Selamat Datang di My Nusantara</h2>
            <p class="p1">Jelajahi kekayaan budaya dari seluruh daerah di Indonesia.</p>
        </div>
    </section>

    <main>
        <h3>Eksplorasi Budaya</h3>
        <p class="p">Klik pada wilayah di peta untuk melihat informasi masing-masing.</p>
        <section class="map-container">
            <div id="map" alt="Peta Budaya" class="responsive-image"></div>
        </section>

    <section class="content-section">
    <h3><?php echo htmlspecialchars($region); ?></h3>
    <div class="region-box">
        <?php if (!empty($contentData['title'])): ?>
        <h3 class="content-title"><?php echo htmlspecialchars($contentData['title']); ?></h3>
    <?php endif; ?>
        <div class="region-info">
            <?php echo nl2br(htmlspecialchars($contentData['description'] ?? '')); ?>
        </div>
        <?php if (!empty($contentData['culture_items'])): ?>
            <div class="culture-section">
            <h3>Budaya dan Tradisi</h3>
            <?php
                echo '<div class="culture-item">' . nl2br(htmlspecialchars($contentData['culture_items'])) . '</div>';
            ?>
        </div>
        <?php endif; ?>
        <?php if (!empty($contentData['unique_facts'])): ?>
        <div class="unique-facts">
            <h3>Fakta Unik</h3>
            <ul>
                <?php
                    $facts = explode("\n", $contentData['unique_facts']);
                    foreach ($facts as $fact) {
                        $fact = trim($fact);
                        if ($fact !== '') {
                            echo '<li>' . htmlspecialchars($fact) . '</li>';
                        }
                    }
                ?>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="event-section" id="acara">
    <h3>Event</h3>
    <p class="p">Tiket acara kebudayaan yang akan hadir</p><br>   
    <div class="event-cards-container">
        <?php
        $eventQuery = "SELECT a.* FROM acara a JOIN wilayah w ON a.id_wilayah = w.id_wilayah WHERE w.nama_wilayah = ?";
        $eventStmt = $conn->prepare($eventQuery);
        $eventStmt->bind_param("s", $region);
        $eventStmt->execute();
        $eventResult = $eventStmt->get_result();
        if ($eventResult && $eventResult->num_rows > 0) {
            while ($row = $eventResult->fetch_assoc()) {
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
                    <li><a href="index1.php">Beranda</a></li>
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
