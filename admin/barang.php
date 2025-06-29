<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = trim($_POST['nama_barang']);
    $nama_barang = $conn->real_escape_string($nama_barang);

    $gambar_barang = "";
    if (isset($_FILES['gambar_barang']) && $_FILES['gambar_barang']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $target_file = $target_dir . basename($_FILES["gambar_barang"]["name"]);
        if (move_uploaded_file($_FILES["gambar_barang"]["tmp_name"], $target_file)) {
            $gambar_barang = $conn->real_escape_string(basename($_FILES["gambar_barang"]["name"]));
        } else {
            echo "Error uploading file.";
            exit();
        }
    } else {
        echo "No file uploaded or upload error.";
        exit();
    }

    $harga_barang = isset($_POST['harga_barang']) ? floatval($_POST['harga_barang']) : 0;

    $sql = "INSERT INTO barang_tradisional (nama_barang, gambar_barang, harga_barang) VALUES ('$nama_barang', '$gambar_barang', $harga_barang)";
    if ($conn->query($sql) === TRUE) {
        header("Location: barang.php?Data berhasil ditambahkan");
    } else {
        echo "Error: " . $conn->error;
    }
}
if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];

    $sql = "DELETE FROM barang_tradisional WHERE `id_barang`=$id_barang"; 

    if ($conn->query($sql) === TRUE) {
        header("Location: barang.php?Data berhasil dihapus");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin-barang</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css">
</head>
<body>
    <h3 class="admin-subtitle">Halaman Admin yang lain :</h3>
        <ul>
            <a href="admin.php"class="admin-link">Admin user</a>
            <a href="wilayah.php" class="admin-link">Wilayah</a>
            <a href="budaya.php" class="admin-link">Budaya</a>
            <a href="acara.php" class="admin-link">Acara</a>
            <a href="orders.php" class="admin-link">Pesanan</a>
            <a href="explor.php" class="admin-link">Interface</a>
            <a href="/MY_NUSANTARA/beranda/index1.php" class="admin-link">Beranda</a>
        </ul>
        <br>    
    <div class="container">    
    <form method="post" enctype="multipart/form-data" class="admin-form">
        <h3 class="admin-subtitle">Tambah Data</h3>
        Nama barang: <input type="text" name="nama_barang" required class="admin-input"><br><br>
        Gambar barang: <input type="file" name="gambar_barang" required class="admin-input"><br><br>
        Harga barang: <input type="number" step="0.01" name="harga_barang" required class="admin-input"><br><br>
        <input type="submit" value="Simpan" class="admin-button">
    </form>
        </div>

    <h2 class="admin-subtitle">Barang tradisional</h2>
    <table class="admin-table">
        <tr class="admin-table-header">
            <th>ID barang</th>
            <th>Nama barang</th>
            <th>Gambar barang</th>
            <th>harga barang</th>
            <th>Aksi</th>
        </tr>
        <?php
    $sql = "SELECT id_barang, nama_barang, gambar_barang, harga_barang FROM barang_tradisional";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr class='admin-table-row'>
                    <td class='admin-table-cell'>{$row['id_barang']}</td>
                    <td class='admin-table-cell'>{$row['nama_barang']}</td>
                    <td class='admin-table-cell'><img src='uploads/{$row['gambar_barang']}' alt='{$row['nama_barang']}' style='max-width: 100px; max-height: 100px;'></td>
                    <td class='admin-table-cell'>{$row['harga_barang']}</td>
                    <td class='admin-table-cell'>
                        <a href='edit_brg.php?id={$row['id_barang']}' class='admin-link edit-link'>Edit</a> |
                        <a href='barang.php?id={$row['id_barang']}' onclick='return confirm(\"Hapus data ini?\")' class='admin-link delete-link'>Hapus</a>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='5' style='text-align: center;'>Tidak ada data</td></tr>";

    }
        ?>
    </table>
    
</body>
<footer>    
    <div class="container">
        <p>&copy; 2024 My Nusantara. Semua hak dilindungi.</p>
    </div>
</footer>
</html>
        