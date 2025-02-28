<?php
session_start();
include 'connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $username = $stmt->fetch();

    
    if ($username && password_verify($password, $username['password'])) {
        $_SESSION['loggedInUser'] = $username['username'];

        $_SESSION['user_id'] = $username['id'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <form class="login-form" method="POST" action="">
            <h2>Login</h2>
            <div class="input-group">
                <label for="username"><i class="fas fa-user"></i> Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <p class="error-message">
                <?php if ($error) echo $error; ?>
            </p>
            <p class="register-link">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </form>
    </div>
</body>
</html>
