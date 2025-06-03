<?php
session_start();
include 'config.php';

$order_id = intval($_GET['id'] ?? 0);
if ($order_id <= 0) {
    die('ID pesanan tidak valid.');
}

$orderQuery = "SELECT * FROM orders WHERE id = $order_id LIMIT 1";
$orderResult = mysqli_query($conn, $orderQuery);
if (!$orderResult || mysqli_num_rows($orderResult) == 0) {
    die('Pesanan tidak ditemukan.');
}
$order = mysqli_fetch_assoc($orderResult);

$itemsQuery = "SELECT * FROM order_items WHERE order_id = $order_id";
$itemsResult = mysqli_query($conn, $itemsQuery);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Pesanan #<?php echo $order_id; ?></title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css" />
</head>
<body>
    <h1 class="admin-subtitle">Detail Pesanan #<?php echo $order_id; ?></h1>
    <p><strong>Nama:</strong> <?php echo htmlspecialchars($order['name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
    <p><strong>Telepon:</strong> <?php echo htmlspecialchars($order['phone']); ?></p>
    <p><strong>Alamat:</strong> <?php echo nl2br(htmlspecialchars($order['address'])); ?></p>
    <p><strong>Metode Pembayaran:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
    <p><strong>Total:</strong> Rp <?php echo number_format($order['total_amount'], 0, ",", "."); ?></p>
    <p><strong>Tanggal Pesan:</strong> <?php echo htmlspecialchars($order['created_at']); ?></p>

    <h2 class="admin-subtitle">Item Pesanan</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Jenis Produk</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($itemsResult && mysqli_num_rows($itemsResult) > 0): ?>
                <?php while ($item = mysqli_fetch_assoc($itemsResult)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_type']); ?></td>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>Rp <?php echo number_format($item['price'], 0, ",", "."); ?></td>
                        <td>Rp <?php echo number_format($item['subtotal'], 0, ",", "."); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">Tidak ada item dalam pesanan ini.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <p><a href="orders.php" class="admin-link">Kembali ke Daftar Pesanan</a></p>
</body>
</html>
