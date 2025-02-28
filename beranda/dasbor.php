<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'connect.php';
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/login.css">
</head>
<body>
    <div class="container">
        <h2>Anda saat ini sedang menggunakan akun, <?= htmlspecialchars($user['username']); ?></h2>

        <a href="logout.php">Logout</a><br>
       
        <a href="account.php">Tentang Akun Saya</a><br>

        <a href="index.php" >Kembali ke halaman utama...</a>
    </div>
</body>
</html>
