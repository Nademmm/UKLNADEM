<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Sanitize input to prevent SQL injection
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);
    
    // Hash the password before storing
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password_hashed')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan!";
        echo "<a href='admin.php'>Kembali</a>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pengguna</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/admin.css">
</head>
<body>
    <h2>Tambah Pengguna</h2>
    <div class="container">
        <form method="post">
            Nama: <input type="text" name="username" required><br><br>
            Password: <input type="password" name="password" required><br><br>
            <input type="submit" value="Simpan">
        </form>
        <a href="admin.php">Kembali</a>
    </div>
</body>
</html>
