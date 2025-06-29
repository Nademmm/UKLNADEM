<?php
include 'config.php';

if (!isset($_GET['id'])) {
    echo "ID barang tidak ditemukan.";
    exit();
}

$id_barang = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = trim($_POST['nama_barang']);
    $nama_barang = $conn->real_escape_string($nama_barang);

    $harga_barang = isset($_POST['harga_barang']) ? floatval($_POST['harga_barang']) : 0;

    $sql_select = "SELECT gambar_barang FROM barang_tradisional WHERE id_barang = $id_barang";
    $result_select = $conn->query($sql_select);
    if ($result_select->num_rows == 0) {
        echo "Data tidak ditemukan.";
        exit();
    }
    $row = $result_select->fetch_assoc();
    $current_gambar = $row['gambar_barang'];

    $gambar_barang = $current_gambar;
    if (isset($_FILES['gambar_barang']) && $_FILES['gambar_barang']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $target_file = $target_dir . basename($_FILES["gambar_barang"]["name"]);
        if (move_uploaded_file($_FILES["gambar_barang"]["tmp_name"], $target_file)) {
            $gambar_barang = $conn->real_escape_string(basename($_FILES["gambar_barang"]["name"]));

            if ($current_gambar && $current_gambar != $gambar_barang && file_exists($target_dir . $current_gambar)) {
                unlink($target_dir . $current_gambar);
            }
        } else {
            echo "Error uploading file.";
            exit();
        }
    }

    $sql_update = "UPDATE barang_tradisional SET nama_barang = '$nama_barang', gambar_barang = '$gambar_barang', harga_barang = $harga_barang WHERE id_barang = $id_barang";

    if ($conn->query($sql_update) === TRUE) {
        header("Location: barang.php?Data berhasil diedit");
    } else {
        echo "Error: " . $conn->error;
    }

    } else {
        $sql = "SELECT * FROM barang_tradisional WHERE id_barang = $id_barang";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            echo "Data tidak ditemukan.";
            exit();
        }
        $row = $result->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css">
</head>
<body>
    <div class="container">
        <h1 class="admin-title">Edit Barang</h1>
        <form method="post" enctype="multipart/form-data" class="admin-form">
            Nama barang: <input type="text" name="nama_barang" value="<?php echo htmlspecialchars($row['nama_barang']); ?>" required class="admin-input"><br><br>
            Gambar barang saat ini:<br>
            <?php if ($row['gambar_barang']): ?>
                <img src="uploads/<?php echo htmlspecialchars($row['gambar_barang']); ?>" alt="<?php echo htmlspecialchars($row['nama_barang']); ?>" style="max-width: 150px; max-height: 150px;"><br><br>
            <?php else: ?>
                Tidak ada gambar.<br><br>
            <?php endif; ?>
            Ganti gambar barang: <input type="file" name="gambar_barang" class="admin-input"><br><br>
            Harga barang: <input type="number" step="0.01" name="harga_barang" value="<?php echo htmlspecialchars($row['harga_barang']); ?>" required class="admin-input"><br><br>
            <input type="submit" value="Update" class="admin-button">
        </form>
        <br>
        <a href="barang.php" class="admin-link">Kembali ke daftar barang</a>
    </div>
</body>
<footer>
    <div class="container">
        <p>&copy; 2024 My Nusantara. Semua hak dilindungi.</p>
    </div>
</footer>
</html>
