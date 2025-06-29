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
    <?php include 'header.php'; ?>
    <main>
        <section class="event-detail-view" >
            <?php if (!empty($acara['gambar_acara'])): ?>
                <img src="/MY_NUSANTARA/admin/uploads/<?php echo htmlspecialchars($acara['gambar_acara']); ?>" alt="<?php echo htmlspecialchars($acara['nama_acara']); ?>" style="width:100%; max-width:600px; height:auto; margin-bottom: 20px; border-radius: 12px;">
            <?php endif; ?>
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
<?php include 'footer.php'; ?>
</body>
</html>
