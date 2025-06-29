<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user']['id'];

$query = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pesanan Saya - MY NUSANTARA</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/pesanan.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=El Messiri:wght@400;700&display=swap" />
    <script>
        function toggleDetails(orderId) {
            var detailRow = document.getElementById('detail-' + orderId);
            if (detailRow.style.display === 'none' || detailRow.style.display === '') {
                detailRow.style.display = 'table-row';
            } else {
                detailRow.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="pesanan-container">
        <h1>Pesanan Saya</h1>
        <?php if ($result && $result->num_rows > 0): ?>
            <table class="pesanan-table">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Produk Dibeli</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal Pesan</th>
                        <th>Lainnya</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($order = $result->fetch_assoc()): ?>
                    <?php
                    $order_id = $order['id'];
                    $items_query = "SELECT oi.quantity, COALESCE(b.nama_barang, a.nama_acara) AS product_name, (a.id_acara IS NOT NULL) AS is_ticket FROM order_items oi LEFT JOIN barang_tradisional b ON oi.product_id = b.id_barang LEFT JOIN acara a ON oi.product_id = a.id_acara WHERE oi.order_id = ?";
                    $items_stmt = $conn->prepare($items_query);
                    $items_stmt->bind_param("i", $order_id);
                    $items_stmt->execute();
                    $items_result = $items_stmt->get_result();
                    ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td>
                            <ul style="padding-left: 18px; margin: 0;">
                                <?php while ($item = $items_result->fetch_assoc()): ?>
                                    <li>
                                        <?php 
                                            echo htmlspecialchars($item['product_name']);
                                            if ($item['is_ticket']) {
                                                echo ' (Tiket)';
                                            }
                                            echo ' x' . $item['quantity']; 
                                        ?>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </td>
                        <td>Rp <?php echo number_format($order['total_amount'], 0, ",", "."); ?></td>
                        <td>
                            <?php 
                                echo htmlspecialchars($order['status']); 
                                if ($order['status'] === 'pending' && $order['payment_method'] === 'ewallet'): 
                            ?>
                                <br><span style="color: red; font-weight: bold;">Pesanan Anda belum dibayar</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                        <td>
                            <button class="btn-lihat" onclick="toggleDetails(<?php echo $order['id']; ?>)">Lihat Detail Pesanan</button>
                        </td>
                    </tr>
                    <tr id="detail-<?php echo $order['id']; ?>" class="detail-row" style="display: none; background-color: #f9f9f9;">
                        <td colspan="6">
                            <strong>Detail Pesanan:</strong><br>
                            Nama: <?php echo htmlspecialchars($order['name']); ?><br>
                            Email: <?php echo htmlspecialchars($order['email']); ?><br>
                            Telepon: <?php echo htmlspecialchars($order['phone']); ?><br>
                            Alamat: <?php echo htmlspecialchars($order['address']); ?><br>
                            Metode Pembayaran: <?php echo htmlspecialchars($order['payment_method']); ?><br>
                            <?php if (in_array($order['status'], ['pending', 'paid'])): ?>
                                <br>
                                <a href="edit_order_user.php?id=<?php echo $order['id']; ?>" class="buy-button">Edit Alamat</a>
                                <a href="cancel_order_user.php?id=<?php echo $order['id']; ?>" class="buy-button-cancel" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');" style="margin-left: 10px;">Batalkan Pesanan</a>
                                <?php if ($order['status'] === 'pending' && $order['payment_method'] === 'ewallet'): ?>
                                    <br><br>
                                    <a href="ewallet_payment.php?order_id=<?php echo $order['id']; ?>" class="buy-button">Unggah Bukti Pembayaran</a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Kamu belum memiliki pesanan, belanja yuk!!</p>
        <?php endif; ?><br><br>
        <a href="index1.php" class="buy-button">Kembali ke Beranda</a>
    </div> 
    <?php include 'footer.php'; ?>
</body>
</html>
