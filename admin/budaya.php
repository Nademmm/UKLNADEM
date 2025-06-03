<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_budaya = trim($_POST['nama_budaya']);
    $id_wilayah = $_POST['id_wilayah'];

    $nama_budaya = $conn->real_escape_string($nama_budaya);
    $id_wilayah = (int) $id_wilayah;

    $sql = "INSERT INTO budaya (nama_budaya, id_wilayah) VALUES ('$nama_budaya', $id_wilayah)";
    if ($conn->query($sql) === TRUE) {
        header("Location: budaya.php?Data berhasil ditambahkan");
    } else {
        echo "Error: " . $conn->error;
    }
}
if (isset($_GET['id'])) {
    $id_budaya = $_GET['id'];

    $sql = "DELETE FROM budaya WHERE `id_budaya`=$id_budaya"; 

    if ($conn->query($sql) === TRUE) {
        header("Location: budaya.php?Data berhasil dihapus");
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
    <title>admin-budaya</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css">
</head>
<body>    
    <div class="container">
        <h3 class="admin-subtitle">Tambah Data</h3>
        <form method="post" class="admin-form">
            Nama budaya: <input type="text" name="nama_budaya" required class="admin-input"><br><br>
            Wilayah:
            <select name="id_wilayah" required class="admin-input">
                <option value=""> Pilih Wilayah </option>
                <?php
                $wilayah = $conn->query("SELECT id_wilayah, nama_wilayah FROM wilayah");
                while ($w = $wilayah->fetch_assoc()) {
                    echo "<option value='{$w['id_wilayah']}'>{$w['nama_wilayah']}</option>";
                }
                ?>
            </select><br><br>
            <input type="submit" value="Simpan" class="admin-button">
        </form>
    </div>

<h2 class="admin-subtitle">BUDAYA</h2>
<table class="admin-table">
    <tr class="admin-table-header">
        <th>ID Budaya</th>
        <th>Nama Budaya</th>
        <th>Wilayah</th>
        <th>Aksi</th>
    </tr>
    <?php
        $sql = "SELECT b.id_budaya, b.nama_budaya, w.nama_wilayah 
                FROM budaya b 
                JOIN wilayah w ON b.id_wilayah = w.id_wilayah";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo"<tr class='admin-table-row'>
                        <td class='admin-table-cell'>{$row['id_budaya']}</td>
                        <td class='admin-table-cell'>{$row['nama_budaya']}</td>
                        <td class='admin-table-cell'>{$row['nama_wilayah']}</td>
                        <td class='admin-table-cell'>
                            <a href='edit_budaya.php?id={$row['id_budaya']}' class='admin-link edit-link'>Edit</a> |
                            <a href='budaya.php?id={$row['id_budaya']}' onclick='return confirm(\"Hapus data ini?\")'class='admin-link delete-link'>Hapus</a>
                        </td>
                     </tr>";
                    }   
                }
    ?>
</table>
<h3 class="admin-subtitle">Halaman Admin yang lain :</h3>
    <ul>
        <a href="admin.php"class="admin-link">Admin user</a>
        <a href="wilayah.php" class="admin-link">Wilayah</a>
        <a href="acara.php" class="admin-link">Acara</a>
        <a href="barang.php" class="admin-link">Barang</a>
        <a href="orders.php" class="admin-link">Pesanan</a>
        <a href="explor.php" class="admin-link">Interface</a>
        <a href="/MY_NUSANTARA/beranda/index1.php" class="admin-link">Beranda</a>
    </ul>
    <br>
</body>
<footer>    
    <div class="container">
        <p>&copy; 2024 My Nusantara. Semua hak dilindungi.</p>
    </div>
</footer>
</html>
        