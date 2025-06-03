<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before updating
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET username='$username', password='$password_hashed' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php?Data berhasil diedit");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css">
</head>
<body>
    <h2 class="admin-subtitle">Edit User</h2>
    <form action="" method="POST">

        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        
        <input type="submit" value="Update">

    </form>
    <a href="admin.php"class="admin-link">Kembali</a>
</body>
</html>
