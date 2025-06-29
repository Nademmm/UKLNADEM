<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_wilayah = trim($_POST['nama_wilayah']);
    $nama_wilayah = $conn->real_escape_string($nama_wilayah);
    
    $sql = "INSERT INTO wilayah (nama_wilayah) VALUES ('$nama_wilayah')";
    if ($conn->query($sql) === TRUE) {
        header("Location: wilayah.php?Data berhasil ditambahkan");
    } else {
        echo "Error: " . $conn->error;
    }
}
if (isset($_GET['id'])) {
    $id_wilayah = $_GET['id'];

    $sql = "DELETE FROM wilayah WHERE `id_wilayah`=$id_wilayah"; 

    if ($conn->query($sql) === TRUE) {
        header("Location: wilayah.php?Data berhasil dihapus");
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
    <title>admin-wilayah</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css">
</head>
<body>
    <h3 class="admin-subtitle">Halaman Admin yang lain :</h3>
    <ul>
        <a href="admin.php"class="admin-link">Admin user</a>
        <a href="budaya.php" class="admin-link">Budaya</a>
        <a href="acara.php" class="admin-link">Acara</a>
        <a href="barang.php" class="admin-link">Barang</a>
        <a href="orders.php" class="admin-link">Pesanan</a>
        <a href="explor.php" class="admin-link">Interface</a>
        <a href="/MY_NUSANTARA/beranda/index1.php" class="admin-link">Beranda</a>
    </ul>
    <br>
    <div class="container">
        <h3 class="admin-subtitle">Tambah Data</h3>
        <form method="post">
            Nama wilayah: <input type="text" name="nama_wilayah" required><br><br>
            <input type="submit" value="Simpan">
        </form>
    </div>

<h2 class="admin-subtitle">WILAYAH</h2>
<table class="admin-table">
    <tr class="admin-table-header">
        <th>ID Wilayah</th>
        <th>Nama Wilayah</th>
        <th>Aksi</th>
    </tr>
    <?php
        $sql = "SELECT id_wilayah, nama_wilayah FROM wilayah";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='admin-table-row'>
                        <td class='admin-table-cell'>{$row['id_wilayah']}</td>
                        <td class='admin-table-cell'>{$row['nama_wilayah']}</td>
                        <td class='admin-table-cell'>
                            <a href='edit_wilayah.php?id={$row['id_wilayah']}' class='admin-link edit-link'>Edit</a> |
                            <a href='wilayah.php?id={$row['id_wilayah']}' onclick='return confirm(\"Hapus data ini?\")' class='admin-link delete-link'>Hapus</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4' style='text-align: center;'>Tidak ada data</td></tr>";
        }
    ?>
</table>
<br>
    
</body>
<footer>
        <div class="container">
            <p>&copy; 2024 My Nusantara. Semua hak dilindungi.</p>
        </div>
</footer>
</html>
