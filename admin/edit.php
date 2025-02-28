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
        echo "Data berhasil diperbarui!";
        header("Location: admin.php");
        exit();
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
    <link rel="stylesheet" href="/MY_NUSANTARA/css/admin.css">
</head>
<body>
    <h2 style="text-align: center; color: #333;">Edit User</h2>
    <form action="" method="POST" style="max-width: 400px; margin: auto;">

        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $row['username']; ?>" required style="width: 100%; padding: 8px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px;">
        
        <label for="password">Password:</label>
        <input type="password" name="password" required style="width: 100%; padding: 8px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px;">
        
        <button type="submit" style="background-color: #b7980f; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">Update</button>

    </form>
    <a href="admin.php" style="display: block; text-align: center; margin-top: 20px;">Kembali</a>
</body>
</html>
