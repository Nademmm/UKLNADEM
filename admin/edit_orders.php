<?php
session_start();
include '../beranda/connect.php';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'] ?? $order['status'];
    $address = $_POST['address'] ?? $order['address'];

    $stmt = $conn->prepare("UPDATE orders SET status = ?, address = ? WHERE id = ?");
    $stmt->bind_param("ssi", $status, $address, $order_id);
    if ($stmt->execute()) {
        header("Location: orders.php?Data berhasil diedit");
        exit();
    } else {
        $error = "Gagal memperbarui status pesanan: " . $stmt->error;
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Status pesanan id <?php echo $order_id; ?></title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css" />
</head>
<body>
    <h1 class="admin-subtitle">Edit Status pesanan id <?php echo $order_id; ?></h1>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="status">Status Pesanan:</label>
        <select name="status" id="status" required>
            <?php
            $statuses = ['pending', 'paid', 'shipped', 'completed', 'cancelled'];
            foreach ($statuses as $s) {
                $selected = ($order['status'] === $s) ? 'selected' : '';
                echo "<option value=\"$s\" $selected>" . ucfirst($s) . "</option>";
            }
            ?>
        </select>
        <br><br> 
        <label for="address">Alamat Pengiriman:</label>
        <textarea name="address" id="address" rows="4" required><?php echo htmlspecialchars($order['address']); ?></textarea>
        <br><br>
        <button type="submit">Update</button>
    </form>
    <p><a href="orders.php" class="admin-link">Kembali ke Daftar Pesanan</a></p>
</body>
</html>
