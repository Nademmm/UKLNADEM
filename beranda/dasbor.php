<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Judson:wght@700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=El Messiri:wght@400;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ek Mukta:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
</head>
<body>  
    <div class="container">
        <h2>Anda saat ini sedang menggunakan akun, <?= htmlspecialchars($user['username']); ?></h2>
        <a href="logout.php" class="logout-button" onclick="return confirm('Apakah yakin anda ingin logout?')">Logout</a><br><br>
        <a href="account.php" class="logout-button">Tentang Akun Saya</a><br><br>
        <?php if ($user['username'] === 'admin'): ?>
            <a href="/MY_NUSANTARA/admin/admin.php" class="logout-button">Ke Halaman Admin</a><br><br>
        <?php endif; ?>
        <a href="index1.php" class="logout-button">Kembali ke halaman utama...</a>
    </div>
</body>
</html>