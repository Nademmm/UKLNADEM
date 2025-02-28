<?php
include 'connect.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    if ($stmt->rowCount() > 0) {
        $error = "Username sudah terdaftar!";
    } else {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        if ($stmt->execute(['username' => $username, 'password' => $hashedPassword])) {
            $success = "Pendaftaran berhasil! Silakan login.";
        } else {
            $error = "Terjadi kesalahan saat mendaftar.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="container">
        <form class="register-form" method="POST" action="">
            <h2>Daftar</h2>
            <div class="input-group">
                <label for="username"><i class="fas fa-user"></i> Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Daftar</button>
            <p class="error-message">
                <?php if ($error) echo $error; ?>
            </p>
            <p class="success-message">
                <?php if ($success) echo $success; ?>
            </p>
            <p class="login-link">Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </form>
    </div>
</body>
</html>
