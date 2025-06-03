<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id_wilayah = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM wilayah WHERE id_wilayah = '$id_wilayah'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        
        echo "Data tidak ditemukan!";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_wilayah = $conn->real_escape_string($_POST['nama_wilayah']);
    
    $sql = "UPDATE wilayah SET nama_wilayah='$nama_wilayah' WHERE id_wilayah='$id_wilayah'";
    if ($conn->query($sql) === TRUE) {
        header("Location: wilayah.php?Data berhasil diedit");
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
    <title>Edit Data wilayah</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css">
</head>
<body>
    <h2 class="admin-subtitle">Edit wilayah</h2>
    <form action="" method="POST">
        
        <label for="nama_wilayah">nama_wilayah:</label>
        <input type="text" name="nama_wilayah" value="<?php echo isset($row['nama_wilayah']) ? htmlspecialchars($row['nama_wilayah']) : ''; ?>" required>
        
        <input type="submit" value="Update">

    </form>
    <a href="wilayah.php"class="admin-link">Kembali</a>
</body>
</html>
