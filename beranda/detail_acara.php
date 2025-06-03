<?php
session_start();
include 'connect.php';

$loggedInUser = isset($_SESSION['user']) ? $_SESSION['user']['username'] : null;

if (!isset($_GET['id_acara'])) {
    header('Location: index1.php');
    exit;
}

$id_acara = intval($_GET['id_acara']);
$query = "SELECT * FROM acara WHERE id_acara = $id_acara LIMIT 1;";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Acara tidak ditemukan.";
    exit;
}

$acara = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Acara - <?php echo htmlspecialchars($acara['nama_acara']); ?></title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/style.css" />
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
                <?php if ($loggedInUser): ?>
                    <a href="dasbor.php"><img src="/MY_NUSANTARA/image/image.png" alt="User" class="icon" /></a>
                <?php else: ?>
                    <a href="login.php" id="loginButton"><img src="/MY_NUSANTARA/image/image.png" alt="User" class="icon" /></a>
                <?php endif; ?>
                <a href="keranjang.php"><img src="/MY_NUSANTARA/image/icon.png" alt="Cart" class="icon" /></a>
            </nav>
        </div>
    </header>

    <main>
        <section class="event-detail-view" style="border: 1px solid #ccc; padding: 15px; margin: 20px;">
            <h2 class="h2a"><?php echo htmlspecialchars($acara['nama_acara']); ?></h2> 
            <p><?php echo nl2br(htmlspecialchars($acara['deskripsi'])); ?></p>
            <p><strong>Tempat:</strong> <?php echo htmlspecialchars($acara['tempat_acara']); ?></p>
            <p><strong>Tanggal:</strong> <?php echo htmlspecialchars($acara['tanggal_acara']); ?></p>
            <p><strong>Jumlah Tiket Tersedia:</strong> <?php echo htmlspecialchars($acara['quantity']); ?></p>
            <p><strong>Harga:</strong> Rp <?php echo number_format($acara['harga'], 0, ",", "."); ?></p><br>
           
            <button class="buy-button" onclick="addToCart('acara', <?php echo $acara['id_acara']; ?>)">Beli Tiket</button><br><br>
            <a href="index1.php" class="buy-button">Kembali</a>
            <script> //nambah js gae notif
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
</body>
</html>
