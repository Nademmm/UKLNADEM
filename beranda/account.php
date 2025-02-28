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

$update_success = false; // Initialize update success variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        // Update username and password
        $new_username = $_POST['username'];
        $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET username = :username, password = :password WHERE id = :id");
        $stmt->execute(['username' => $new_username, 'password' => $new_password, 'id' => $user['id']]);
        $_SESSION['loggedInUser'] = $new_username; // Update session with new username

        $update_success = true; // Set update success to true
    } elseif (isset($_POST['delete'])) {
        // Delete account
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $user['id']]);
        header("Location: logout.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/login.css">
</head>
<body>
    <div class="container" style="max-width: 600px; margin: auto;">
        <h2 style="text-align: center;">Kelola Akun Anda</h2>
        <form method="POST">
            <label for="username">Nama Pengguna:</label>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
            <label for="password">Password Baru:</label>
            <input type="password" name="password" required style="margin-bottom: 10px;">

            <button type="submit" name="update" style="margin-bottom: 10px;">Perbarui Akun</button>
            <?php if ($update_success): ?>
                <p style="color: green;">Akun berhasil diperbarui!</p>
                <a href="index.php" style="display: inline-block; margin-top: 15px;">Kembali ke Halaman Utama</a>
            <?php endif; ?>
        </form>
        <form method="POST" onsubmit="return confirm('Apakah Anda yakin untuk menghapus akun?');">
            <button type="submit" name="delete" style="margin-bottom: 15px;">Hapus Akun</button>
        </form>
        <a href="register.php" onclick="return confirm('Apakah Anda ingin menambahkan akun baru?');" style="display: inline-block; margin-top: 10px;">Tambah Akun</a>
    </div>
</body>
</html>
