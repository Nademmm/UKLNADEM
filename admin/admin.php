<?php
include 'config.php';
if (isset($_GET['hapus']) && is_numeric($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $result = $conn->query("SELECT id FROM orders WHERE user_id = $id");
    while ($row = $result->fetch_assoc()) {
        $orderId = $row['id'];
        $conn->query("DELETE FROM order_items WHERE order_id = $orderId");
    }
    $conn->query("DELETE FROM orders WHERE user_id = $id");
    $conn->query("DELETE FROM users WHERE id = $id");
    header("Location: admin.php?pesan=Data berhasil dihapus");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css">
</head>
<body>
    <div class="container">
        <h1 class="admin-title">ADMIN</h1>
    </div>
        <h3 class="admin-subtitle">Halaman Admin yang lain :</h3>
    <ul>
        <a href="wilayah.php" class="admin-link">Wilayah</a>
        <a href="budaya.php" class="admin-link">Budaya</a>
        <a href="acara.php" class="admin-link">Acara</a>
        <a href="barang.php" class="admin-link">Barang</a>
        <a href="orders.php" class="admin-link">Pesanan</a>
        <a href="explor.php" class="admin-link">Interface</a>
        <a href="/MY_NUSANTARA/beranda/index1.php" class="admin-link">Beranda</a>
    </ul>
    <br>
    
    <h2 class="admin-subtitle">Daftar Pengguna</h2>
    <a href="add.php" class="admin-link">Tambah Data</a>
        
    <table class="admin-table">
        <tr class="admin-table-header"> 
            <th>ID</th>
            <th>Foto Profil</th>
            <th>Nama</th>
            <th>Password</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT id, username, password, pp_user FROM users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $profilePic = !empty($row['pp_user']) ? "/MY_NUSANTARA/admin/uploads/" . htmlspecialchars($row['pp_user']) : "/MY_NUSANTARA/image/image.png";
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td><img src='{$profilePic}' alt='Foto Profil' style='width: 40px; height: 40px; border-radius: 50%; object-fit: cover;'></td>
                        <td>{$row['username']}</td>
                        <td>*********</td>
                        <td>
                            <a href='edit.php?id={$row['id']}' class='admin-link'>Edit</a>
                            <a href='admin.php?hapus={$row['id']}' onclick='return confirm(\"Hapus data ini?\")' class='admin-link'>Hapus</a>
                        </td>
                    </tr>";}
        } else {
            echo "<tr><td colspan='5' style='text-align: center;'>Tidak ada data</td></tr>";
        }
        ?>
    </table><br> 

</body>
<footer>
        <div class="container">
            <p>&copy; 2024 My Nusantara. Semua hak dilindungi.</p>
        </div>
</footer>
</html>
<?php
$conn->close();
?>
