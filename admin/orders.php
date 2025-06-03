<?php
session_start();
include 'config.php';

$query = "SELECT o.id, u.username, o.name, o.email, o.phone, o.address, o.payment_method, o.total_amount, o.status, o.created_at 
          FROM orders o 
          LEFT JOIN users u ON o.user_id = u.id
          ORDER BY o.created_at DESC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin - Orders</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css" />
</head>
<body>
    <h1 class="admin-subtitle">Daftar Pesanan</h1>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Metode Pembayaran</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal Pesan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($order = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo htmlspecialchars($order['username'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($order['name']); ?></td>
                        <td><?php echo htmlspecialchars($order['email']); ?></td>
                        <td><?php echo htmlspecialchars($order['phone']); ?></td>
                        <td><?php echo htmlspecialchars($order['address']); ?></td>
                        <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                        <td>Rp <?php echo number_format($order['total_amount'], 0, ",", "."); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                        <td>
                            <a class="admin-link edit-link" href="order_details.php?id=<?php echo $order['id']; ?>">Lihat Detail</a>
                            <a class="admin-link edit-link" href="edit_orders.php?id=<?php echo $order['id']; ?>">Edit</a>
                            <a class="admin-link delete-link" href="delete_orders.php?id=<?php echo $order['id']; ?>" onclick="return confirm('Yakin ingin menghapus pesanan ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="11">Tidak ada pesanan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <h3 class="admin-subtitle">Halaman Admin yang lain :</h3>
    <ul>
        <a href="admin.php"class="admin-link">Admin user</a>
        <a href="wilayah.php" class="admin-link">Wilayah</a>
        <a href="acara.php" class="admin-link">Acara</a>
        <a href="budaya.php" class="admin-link">Budaya</a>
        <a href="barang.php" class="admin-link">Barang</a>
        <a href="explor.php" class="admin-link">Interface</a>
        <a href="/MY_NUSANTARA/beranda/index1.php" class="admin-link">Beranda</a>
    </ul>
    <br>
</body>
<footer>    
    <div class="container">
        <p>&copy; 2024 My Nusantara. Semua hak dilindungi.</p>
    </div>
</footer>
</body>
</html>
