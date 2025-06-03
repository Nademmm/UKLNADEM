<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id_budaya = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM budaya WHERE id_budaya = '$id_budaya'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        
        echo "Data tidak ditemukan!";
        exit();
    }
}   

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_budaya = $conn->real_escape_string($_POST['nama_budaya']);
    $id_wilayah = $conn->real_escape_string($_POST['id_wilayah']);
    
    $sql = "UPDATE budaya SET nama_budaya='$nama_budaya', id_wilayah='$id_wilayah'WHERE id_budaya='$id_budaya'";
    if ($conn->query($sql) === TRUE) {
        header("Location: budaya.php?Data berhasil diedit");
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
    <title>Edit Data budaya</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css">
</head>
<body>
    <h2 class="admin-subtitle">Edit budaya</h2>
    <form action="" method="POST">
        
        <label for="nama_budaya">nama_budaya:</label>
        <input type="text" name="nama_budaya" value="<?php echo isset($row['nama_budaya']) ? htmlspecialchars($row['nama_budaya']) : ''; ?>" required>
        <select name="id_wilayah" required class="admin-input">
                <option value=""> Pilih Wilayah </option>
                <?php
                $wilayah = $conn->query("SELECT id_wilayah, nama_wilayah FROM wilayah");
                while ($w = $wilayah->fetch_assoc()) {
                    echo "<option value='{$w['id_wilayah']}'>{$w['nama_wilayah']}</option>";
                }
                ?>
            </select><br><br>
        
        <input type="submit" value="Update">

    </form>
    <a href="budaya.php"class="admin-link">Kembali</a>
</body>
</html>