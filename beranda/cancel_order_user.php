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

$order = null;
$orderQuery = "SELECT * FROM orders WHERE id = ? AND user_id = ? LIMIT 1";
$orderStmt = $conn->prepare($orderQuery);
$orderStmt->bind_param("ii", $order_id, $user_id);
$orderStmt->execute();
$orderResult = $orderStmt->get_result();
if ($orderResult && $orderResult->num_rows > 0) {
    $order = $orderResult->fetch_assoc();
}
$orderStmt->close();

$query = "SELECT * FROM orders WHERE id = ? AND user_id = ? AND status IN ('pending', 'paid') LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
if (!$result || $result->num_rows === 0) {
    die('Pesanan tidak ditemukan atau tidak dapat dibatalkan.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateQuery = "UPDATE orders SET status = 'cancelled' WHERE id = ? AND user_id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ii", $order_id, $user_id);
    if ($updateStmt->execute()) {
        header("Location: pesanan.php");
        exit();
    } else {
        $error = 'Gagal membatalkan pesanan: ' . $conn->error;
    }
} else {
    $error = '';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Batalkan Pesanan <?php echo $order_id; ?></title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/pesanan.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=El Messiri:wght@400;700&display=swap" />
</head>
<body>
    <div class="pesanan-container">
        <h1>Batalkan Pesanan <?php echo $order_id; ?></h1>
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php else: ?>
            <p>Apakah Anda yakin ingin membatalkan pesanan ini?</p>
            <form method="POST" action="">
                <button type="submit">Ya, Batalkan Pesanan</button>
                <a href="pesanan.php" class="cancel-button">Batal</a>
            </form>
        <?php endif; ?>
         <?php if ($order && $order['status'] === 'paid'): ?>
            <p>Hubungi Customer Service untuk pengembalian dana anda!</p>    
            <a href="https://wa.me/qr/2753RE3RT7NXK1">Customer Service</a>   
        <?php endif; ?>
    </div>
</body>
</html>
