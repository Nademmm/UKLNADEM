<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id_acara = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM acara WHERE id_acara = '$id_acara'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_acara = $conn->real_escape_string($_POST['id_acara']);
    $nama_acara = $conn->real_escape_string($_POST['nama_acara']);
    $tempat_acara = $conn->real_escape_string($_POST['tempat_acara']);
    $tanggal_acara = $conn->real_escape_string($_POST['tanggal_acara']);
    $quantity = $conn->real_escape_string($_POST['quantity']);
    $harga = $conn->real_escape_string($_POST['harga']);
    $id_wilayah = $conn->real_escape_string($_POST['id_wilayah']);
    $id_budaya = $conn->real_escape_string($_POST['id_budaya']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);

    $gambar_acara = null;
    if (isset($_FILES['gambar_acara']) && $_FILES['gambar_acara']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $tmpName = $_FILES['gambar_acara']['tmp_name'];
        $fileName = basename($_FILES['gambar_acara']['name']);
        $targetFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($tmpName, $targetFilePath)) {
            $gambar_acara = $fileName;
        } else {
            echo "Gagal mengupload gambar acara.";
            exit();
        }
    }

    $sql = "UPDATE acara 
            SET nama_acara='$nama_acara', 
                tempat_acara='$tempat_acara', 
                tanggal_acara='$tanggal_acara', 
                quantity='$quantity',
                harga='$harga',
                deskripsi='$deskripsi',
                id_wilayah='$id_wilayah',
                id_budaya='$id_budaya'";

    if ($gambar_acara) {
        $sql .= ", gambar_acara='$gambar_acara'";
    }

    $sql .= " WHERE id_acara='$id_acara'";

    if ($conn->query($sql) === TRUE) {
        header("Location: acara.php?Data berhasil diedit");
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
    <title>Edit Data Acara</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css">
</head>
<body>
    <h2 class="admin-subtitle">Edit Acara</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_acara" value="<?php echo htmlspecialchars($row['id_acara']); ?>">

        <label for="nama_acara">Nama Acara:</label>
        <input type="text" name="nama_acara" value="<?php echo htmlspecialchars($row['nama_acara']); ?>" required class="admin-input"><br><br>

        <label for="gambar_acara">Gambar Acara:</label><br>
        <?php if (!empty($row['gambar_acara'])): ?>
            <img src="/MY_NUSANTARA/admin/uploads/<?php echo htmlspecialchars($row['gambar_acara']); ?>" alt="Gambar Acara" style="max-width: 200px; max-height: 200px;"><br>
        <?php endif; ?>
        <input type="file" name="gambar_acara" accept="image/*" class="admin-input"><br><br>

        <label for="id_wilayah">Wilayah:</label>
        <select name="id_wilayah" required class="admin-input">
            <option value="">Pilih Wilayah</option>
            <?php
            $wilayah = $conn->query("SELECT id_wilayah, nama_wilayah FROM wilayah");
            while ($w = $wilayah->fetch_assoc()) {
                $selected = ($w['id_wilayah'] == $row['id_wilayah']) ? 'selected' : '';
                echo "<option value='{$w['id_wilayah']}' $selected>{$w['nama_wilayah']}</option>";
            }
            ?>
        </select><br><br>

        <label for="id_budaya">Budaya:</label>
        <select name="id_budaya" required class="admin-input">
            <option value="">Pilih Budaya</option>
            <?php
            $budaya = $conn->query("SELECT id_budaya, nama_budaya FROM budaya");
            while ($b = $budaya->fetch_assoc()) {
                $selected = ($b['id_budaya'] == $row['id_budaya']) ? 'selected' : '';
                echo "<option value='{$b['id_budaya']}' $selected>{$b['nama_budaya']}</option>";
            }
            ?>
        </select><br><br>

        <label for="tanggal_acara">Tanggal Acara:</label>
        <input type="date" name="tanggal_acara" value="<?php echo htmlspecialchars($row['tanggal_acara']); ?>" required class="admin-input"><br><br>

        <label for="tempat_acara">Tempat Acara:</label>
        <input type="text" name="tempat_acara" value="<?php echo htmlspecialchars($row['tempat_acara']); ?>" required class="admin-input"><br><br>

        <label for="quantity">Jumlah Tiket:</label>
        <input type="number" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>" required class="admin-input"><br><br>

        <label for="harga">Harga Tiket:</label>
        <input type="text" name="harga" value="<?php echo htmlspecialchars($row['harga']); ?>" required class="admin-input"><br><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" required class="admin-input" rows="5"><?php echo htmlspecialchars($row['deskripsi']); ?></textarea><br><br>

        <input type="submit" value="Update" class="admin-button">
    </form>

    <a href="acara.php" class="admin-link">Kembali</a>
</body>
</html>
