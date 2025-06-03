<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_acara = $_POST['nama_acara'];
    $tanggal_acara = $_POST['tanggal_acara'];
    $tempat_acara = $_POST['tempat_acara'];
    $quantity = $_POST['quantity'];
    $id_wilayah = $_POST['id_wilayah'];
    $id_budaya = $_POST['id_budaya'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    $sql = "INSERT INTO acara (nama_acara, tanggal_acara, tempat_acara, quantity, id_wilayah, id_budaya, harga, deskripsi)
    VALUES ('$nama_acara', '$tanggal_acara', '$tempat_acara', '$quantity', '$id_wilayah', '$id_budaya', '$harga', '$deskripsi')";   

    if ($conn->query($sql) === TRUE) {
        header("Location: acara.php?Data berhasil ditambahkan");
    } else {
        echo "Error: " . $conn->error;
    }
}
if (isset($_GET['id'])) {
    $id_acara = $_GET['id'];

    $sql = "DELETE FROM acara WHERE `id_acara`=$id_acara"; 

    if ($conn->query($sql) === TRUE) {
        header("Location: acara.php?Data berhasil dihapus");
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
    <title>admin-acara</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css">
</head>
<body>    
    <div class="container">
        <h3 class="admin-subtitle">Tambah Data</h3>
        <form method="post" class="admin-form">
            Nama acara: <input type="text" name="nama_acara" required class="admin-input"><br><br>
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
            Pilih budaya:
            <select name="id_budaya" required class="admin-input">
                <option value=""> Pilih budaya </option>
                <?php
                $wilayah = $conn->query("SELECT id_budaya, nama_budaya FROM budaya");   
                while ($w = $wilayah->fetch_assoc()) {
                    echo "<option value='{$w['id_budaya']}'>{$w['nama_budaya']}</option>";
                }
                ?>
            </select><br><br>
            Tanggal acara: <input type="date" name="tanggal_acara" required class="admin-input"><br><br>
            Tempat acara: <input type="text" name="tempat_acara" required class="admin-input"><br><br>
            Quantitas tiket: <input type="number" name="quantity" required class="admin-input"><br><br>
            Harga: <input type="price" name="harga" required class="admin-input"><br><br>
            Deskripsi: <input type="text" name="deskripsi" required class="admin-input"><br><br>
            <input type="submit" value="Simpan" class="admin-button">
        </form>
    </div>

<h2 class="admin-subtitle">ACARA</h2>
<table class="admin-table">
    <tr class="admin-table-header">
        <th>ID acara</th>
        <th>Nama acara</th>
        <th>Wilayah</th>
        <th>Budaya</th>
        <th>Tempat acara</th>
        <th>Tanggal acara</th>
        <th>Quantitas tiket</th>
        <th>Harga</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
        
    </tr>
    <?php
    $sql = "SELECT a.*, w.nama_wilayah, b.nama_budaya
            FROM acara a
            JOIN wilayah w ON a.id_wilayah = w.id_wilayah
            JOIN budaya b ON a.id_budaya = b.id_budaya";

    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $fullDesc = htmlspecialchars($row['deskripsi']);
        $shortDesc = strlen($fullDesc) > 100 ? substr($fullDesc, 0, 100) . '...' : $fullDesc;
        echo "<tr>
            <td>{$row['id_acara']}</td>
            <td>{$row['nama_acara']}</td>
            <td>{$row['nama_wilayah']}</td>
            <td>{$row['nama_budaya']}</td>
            <td>{$row['tempat_acara']}</td>
            <td>{$row['tanggal_acara']}</td>
            <td>{$row['quantity']}</td>
            <td>{$row['harga']}</td>
            <td>
                <span class='short-desc'>{$shortDesc}</span>";
        if (strlen($fullDesc) > 100) {
            echo "<span class='full-desc' style='display:none;'>{$fullDesc}</span>
                <a href='javascript:void(0);' class='read-more-link' onclick='toggleDescription(this)'>Read more</a>";
        }
        echo "</td>
            <td class='admin-table-cell'>
                <a href='editA.php?id={$row['id_acara']}' class='admin-link edit-link'>Edit</a> |
                <a href='acara.php?id={$row['id_acara']}' onclick='return confirm(\"Hapus data ini?\")' class='admin-link delete-link'>Hapus</a>
            </td>
        </tr>";
    }
    ?>
</table>
<h3 class="admin-subtitle">Halaman Admin yang lain :</h3>
    <ul>
        <a href="admin.php"class="admin-link">Admin user</a>
        <a href="wilayah.php" class="admin-link">Wilayah</a>
        <a href="budaya.php" class="admin-link">Budaya</a>
        <a href="barang.php" class="admin-link">Barang</a>
        <a href="orders.php" class="admin-link">Pesanan</a>
        <a href="explor.php" class="admin-link">Interface</a>
        <a href="/MY_NUSANTARA/beranda/index1.php" class="admin-link">Beranda</a>
    </ul>
    <br>
    <script>//js iki gae memperdikit penjelasan deskirpsi e
    function toggleDescription(link) {
        var td = link.parentElement;
        var shortDesc = td.querySelector('.short-desc');
        var fullDesc = td.querySelector('.full-desc');
        if (shortDesc.style.display === 'none') {
            shortDesc.style.display = '';
            fullDesc.style.display = 'none';
            link.textContent = 'Read more';
        } else {
            shortDesc.style.display = 'none';
            fullDesc.style.display = '';
            link.textContent = 'Read less';
        }
    }
    </script>
</body>
<footer>    
    <div class="container">
        <p>&copy; 2024 My Nusantara. Semua hak dilindungi.</p>
    </div>
</footer>
</html>
        