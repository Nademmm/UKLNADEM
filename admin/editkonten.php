<?php
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: explor.php");
    exit;
}

$id = intval($_GET['id']);
$message = '';

$sql = "SELECT * FROM wilayah_content WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "Data tidak ditemukan!";
    exit;
}

$row = $result->fetch_assoc();
$wilayahResult = $conn->query("SELECT id_wilayah, nama_wilayah FROM wilayah ORDER BY nama_wilayah ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_wilayah = intval($_POST['id_wilayah']);
    $title = $conn->real_escape_string(trim($_POST['title']));
    $description = $conn->real_escape_string(trim($_POST['description']));
    $unique_facts = $conn->real_escape_string(trim($_POST['unique_facts']));
    $culture_items = $conn->real_escape_string(trim($_POST['culture_items']));

    $updateSql = "UPDATE wilayah_content SET id_wilayah = $id_wilayah, title = '$title', description = '$description', unique_facts = '$unique_facts', culture_items = '$culture_items' WHERE id = $id";

    if ($conn->query($updateSql) === TRUE) {
        header("Location: explor.php?message=Data berhasil diperbarui");
        exit;
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Konten Wilayah</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css" />
</head>
<body>
    <div class="container">
        <h1>Edit Konten Wilayah</h1>

        <?php if ($message): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="post">
            <label>Wilayah:</label><br />
            <select name="id_wilayah" required>
                <option value="">-- Pilih Wilayah --</option>
                <?php while ($wilayah = $wilayahResult->fetch_assoc()): ?>
                    <option value="<?php echo $wilayah['id_wilayah']; ?>" <?php if ($wilayah['id_wilayah'] == $row['id_wilayah']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($wilayah['nama_wilayah']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br />

            <label>Judul:</label><br />
            <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" /><br />

            <label>Deskripsi:</label><br />
            <textarea name="description" rows="4"><?php echo htmlspecialchars($row['description']); ?></textarea><br />

            <label style="text-align:left; display:block;">Budaya dan Tradisi (teks biasa):</label><br />
            <textarea name="culture_items" rows="6" placeholder="Tulis budaya dan tradisi di sini..." style="text-align:left;"><?php echo htmlspecialchars($row['culture_items']); ?></textarea><br />

            <label>Fakta Unik (pisahkan dengan baris baru):</label><br />
            <textarea name="unique_facts" rows="4"><?php echo htmlspecialchars($row['unique_facts']); ?></textarea><br />

            <button type="submit">Simpan</button>
            <a href="explor.php"><button type="button">Batal</button></a>
        </form>
    </div>
</body>
</html>
