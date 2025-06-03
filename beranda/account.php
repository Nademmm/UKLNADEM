<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

include 'connect.php';

// njupuk data pengguna
$user_id = $_SESSION['user']['id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    header("Location: login.php");
    exit;
}

$update_success = false;
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $new_username = $_POST['username'];
        $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $update_query = "UPDATE users SET username='$new_username', password='$new_password' WHERE id={$user['id']}";
        mysqli_query($conn, $update_query);

        $_SESSION['user']['username'] = $new_username; 
        $update_success = true;

    } elseif (isset($_POST['delete'])) {
        $delete_query = "DELETE FROM users WHERE id={$user['id']}";
        mysqli_query($conn, $delete_query);

        header("Location: logout.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Akun</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Judson:wght@700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=El Messiri:wght@400;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ek Mukta:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
</head>
<body>
    <div class="container">
        <form class="login-form" method="post">
            <h2>Kelola Akun</h2>

            <?php if ($update_success): ?>
                <p class="success" style="color: green;">Akun berhasil diperbarui.</p>
            <?php endif; ?>

            <div class="input-group">
                <label for="username"><i class="fas fa-user"></i> Username</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>

            <div class="input-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" name="update">Update Akun</button><br><br>
            <button type="submit" name="delete" onclick="return confirm('Yakin ingin menghapus akun?')">Hapus Akun</button>

            <br><br>
            <a href="dasbor.php">Kembali ke Dasbor</a>
        </form>
    </div>
</body>
</html>
