<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user']['id'];
$order_id = intval($_GET['id'] ?? 0);
if ($order_id <= 0) {
    die('ID pesanan tidak valid.');
}

$query = "SELECT * FROM orders WHERE id = ? AND user_id = ? AND status IN ('pending', 'paid') LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
if (!$result || $result->num_rows === 0) {
    die('Pesanan tidak ditemukan atau tidak dapat diedit.');
}
$order = $result->fetch_assoc();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_address = $_POST['address'] ?? '';
    if (empty(trim($new_address))) {
        $error = 'Alamat tidak boleh kosong.';
    } else {
        $updateQuery = "UPDATE orders SET address = ? WHERE id = ? AND user_id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("sii", $new_address, $order_id, $user_id);
        if ($updateStmt->execute()) {
            header("Location: pesanan.php");
            exit();
        } else {
            $error = 'Gagal memperbarui alamat: ' . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Alamat Pesanan <?php echo $order_id; ?></title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/pesanan.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=El Messiri:wght@400;700&display=swap" />
</head>
<body>
    <div class="pesanan-container">
    <h1>Edit Alamat Pesanan <?php echo $order_id; ?></h1>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="address">Alamat Pengiriman:</label><br>
            <textarea id="address" name="address" rows="4" required><?php echo htmlspecialchars($order['address']); ?></textarea><br><br>
            <button type="submit">Simpan Perubahan</button>
            <a href="pesanan.php" class="cancel-button">Batal</a>
        </form>
    </div>
</body>
</html>
