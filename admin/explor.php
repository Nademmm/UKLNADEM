<?php
include 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $id_wilayah = intval($_POST['id_wilayah']);
    $title = $conn->real_escape_string(trim($_POST['title']));
    $description = $conn->real_escape_string(trim($_POST['description']));
    $unique_facts = $conn->real_escape_string(trim($_POST['unique_facts']));
    $culture_items = $conn->real_escape_string(trim($_POST['culture_items']));

    if ($id > 0) {
        $sql = "UPDATE wilayah_content SET id_wilayah = $id_wilayah, title = '$title', description = '$description', unique_facts = '$unique_facts', culture_items = '$culture_items' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            $message = "Data berhasil diperbarui.";
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        $sql = "INSERT INTO wilayah_content (id_wilayah, title, description, unique_facts, culture_items) VALUES ($id_wilayah, '$title', '$description', '$unique_facts', '$culture_items')";
        if ($conn->query($sql) === TRUE) {
            $message = "Data berhasil ditambahkan.";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM wilayah_content WHERE id = $delete_id");
    header("Location: explor.php");
    exit;
}

$contentResult = $conn->query("SELECT wc.*, w.nama_wilayah FROM wilayah_content wc JOIN wilayah w ON wc.id_wilayah = w.id_wilayah ORDER BY wc.id ASC");
$wilayahResult = $conn->query("SELECT id_wilayah, nama_wilayah FROM wilayah ORDER BY nama_wilayah ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin - Kelola Wilayah Content</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/adminfix.css" />
</head>
<body>
    <div class="container" >
        <h1 class="admin-subtitle">Kelola Konten Interface</h1>
        <?php if ($message): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="post" id="contentForm">
            <input type="hidden" name="id" id="contentId" value="0" />
            <label>Wilayah:</label><br />
            <select name="id_wilayah" id="idWilayah" required>
                <option value="">-- Pilih Wilayah --</option>
                <?php while ($row = $wilayahResult->fetch_assoc()): ?>
                    <option value="<?php echo $row['id_wilayah']; ?>"><?php echo htmlspecialchars($row['nama_wilayah']); ?></option>
                <?php endwhile; ?>
            </select><br />
            <label>Judul:</label><br />
            <input type="text" name="title" id="title" /><br />
            <label>Deskripsi:</label><br />
            <textarea name="description" id="description" rows="4"></textarea><br />
            <label style="text-align:left; display:block;">Budaya dan Tradisi:</label><br />
            <textarea name="culture_items" id="cultureItems" rows="6" placeholder="Tulis budaya dan tradisi di sini..." style="text-align:left;"></textarea><br />
            <label>Fakta Unik (pisahkan dengan baris baru):</label><br />
            <textarea name="unique_facts" id="uniqueFacts" rows="4"></textarea><br />
            <button type="submit">Simpan</button>
            <button type="button" onclick="resetForm()">Batal</button>
        </form>
    </div>

    <h2 class="admin-subtitle">Daftar Konten Wilayah</h2>
        <table class="admin-table">
            <thead>
                <tr>
                <th>ID</th>
                <th>Wilayah</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Budaya dan Tradisi</th>
                <th>Fakta Unik</th>
                <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $contentResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['nama_wilayah']); ?></td>
                    <td><strong><?php echo htmlspecialchars($row['title']); ?></strong></td>
                    <td>
                        <?php
                        $fullDesc = htmlspecialchars($row['description']);
                        $shortDesc = strlen($fullDesc) > 100 ? substr($fullDesc, 0, 100) . '...' : $fullDesc;
                        echo "<span class='short-desc'>{$shortDesc}</span>";
                        if (strlen($fullDesc) > 100) {
                            echo "<span class='full-desc' style='display:none;'>{$fullDesc}</span>
                                <a href='javascript:void(0);' class='read-more-link' onclick='toggleDescription(this)'>Read more</a>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $fullCulture = htmlspecialchars($row['culture_items']);
                        $shortCulture = strlen($fullCulture) > 100 ? substr($fullCulture, 0, 100) . '...' : $fullCulture;
                        echo "<span class='short-desc'>{$shortCulture}</span>";
                        if (strlen($fullCulture) > 100) {
                            echo "<span class='full-desc' style='display:none;'>{$fullCulture}</span>
                                <a href='javascript:void(0);' class='read-more-link' onclick='toggleDescription(this)'>Read more</a>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $fullFacts = htmlspecialchars($row['unique_facts']);
                        $shortFacts = strlen($fullFacts) > 100 ? substr($fullFacts, 0, 100) . '...' : $fullFacts;
                        echo "<span class='short-desc'>{$shortFacts}</span>";
                        if (strlen($fullFacts) > 100) {
                            echo "<span class='full-desc' style='display:none;'>{$fullFacts}</span>
                                <a href='javascript:void(0);' class='read-more-link' onclick='toggleDescription(this)'>Read more</a>";
                        }
                        ?>
                    </td>
                    <td>
                    <a href="editkonten.php?id=<?php echo $row['id']; ?>" class='admin-link edit-link'>Edit</a>
                    <a href="explor.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Hapus konten ini?')" class='admin-link edit-link'>Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <h3 class="admin-subtitle">Halaman Admin yang lain :</h3>
    <ul>
        <a href="admin.php"class="admin-link">Admin user</a>
        <a href="wilayah.php" class="admin-link">Wilayah</a>
        <a href="budaya.php" class="admin-link">Budaya</a>
        <a href="acara.php" class="admin-link">Acara</a>
        <a href="barang.php" class="admin-link">Barang</a>
        <a href="orders.php" class="admin-link">Pesanan</a>
        <a href="/MY_NUSANTARA/beranda/index1.php" class="admin-link">Beranda</a>
    </ul>
    <br>
    <script>//js gae mempersingkat
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
</html>
