<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/admin.css">
</head>
<body>
    <div class=container>
    <h1 style="text-align: center; color: #333;">ADMIN</h1>

    </div>
    <h2 style="text-align: center; color: #333;">Daftar Pengguna</h2>

    <a href="add.php">Tambah Data</a>
    <table style="width: 100%; border: 1px solid #ddd; border-radius: 5px; overflow: hidden;">

        <tr style="background-color: #f9f9f9;">

            <th style="padding: 12px; background-color: #b7980f; color: white;">ID</th>

            <th style="padding: 12px; background-color: #b7980f; color: white;">Nama</th>

            <th style="padding: 12px; background-color: #b7980f; color: white;">Password</th>

            <th style="padding: 12px; background-color: #b7980f; color: white;">Aksi</th>

        </tr>
        <?php
$sql = "SELECT id, username, password FROM users";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr style='border-bottom: 1px solid #ddd;'>

                        <td style='padding: 12px;'>{$row['id']}</td>

                        <td style='padding: 12px;'>{$row['username']}</td>

                        <td style='padding: 12px;'>********</td>


                        <td style='padding: 12px;'>

                            <a href='edit.php?id={$row['id']}' style='color: blue;'>Edit</a> |
                            <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Hapus data ini?\")' style='color: red;'>Hapus</a>

                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4' style='text-align: center;'>Tidak ada data</td></tr>";

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
<?php
$conn->close();
?>
