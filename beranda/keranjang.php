<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['increase_barang'])) {
    $id_barang = intval($_GET['increase_barang']);
    if (isset($_SESSION['cart']['barang'][$id_barang])) {
        $_SESSION['cart']['barang'][$id_barang]['quantity'] += 1;
    }
    header("Location: keranjang.php");
    exit();
}

if (isset($_GET['decrease_barang'])) {
    $id_barang = intval($_GET['decrease_barang']);
    if (isset($_SESSION['cart']['barang'][$id_barang])) {
        $_SESSION['cart']['barang'][$id_barang]['quantity'] -= 1;
        if ($_SESSION['cart']['barang'][$id_barang]['quantity'] < 1) {
            unset($_SESSION['cart']['barang'][$id_barang]);
        }
    }
    header("Location: keranjang.php");
    exit();
}

if (isset($_GET['add_barang'])) {
    $id_barang = intval($_GET['add_barang']);
    $sql = "SELECT id_barang, nama_barang, gambar_barang, harga_barang FROM barang_tradisional WHERE id_barang = $id_barang LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $barang = mysqli_fetch_assoc($result);
        if (isset($_SESSION['cart']['barang'][$id_barang])) {
            $_SESSION['cart']['barang'][$id_barang]['quantity'] += 1;
        } else {
            $_SESSION['cart']['barang'][$id_barang] = [
                'id_barang' => $barang['id_barang'],
                'nama_barang' => $barang['nama_barang'],
                'gambar_barang' => $barang['gambar_barang'],
                'harga_barang' => $barang['harga_barang'],
                'quantity' => 1
            ];
        }
    }
    header("Location: keranjang.php");
    exit();
}

if (isset($_GET['add_acara'])) {
    $id_acara = intval($_GET['add_acara']);
    $sql = "SELECT id_acara, nama_acara, harga FROM acara WHERE id_acara = $id_acara LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $acara = mysqli_fetch_assoc($result);
        if (isset($_SESSION['cart']['acara'][$id_acara])) {
            $_SESSION['cart']['acara'][$id_acara]['quantity'] += 1;
        } else {
            $_SESSION['cart']['acara'][$id_acara] = [
                'id_acara' => $acara['id_acara'],
                'nama_acara' => $acara['nama_acara'],
                'harga' => $acara['harga'],
                'quantity' => 1
            ];
        }
    }
    header("Location: keranjang.php");
    exit();
}

if (isset($_GET['increase_acara'])) {
    $id_acara = intval($_GET['increase_acara']);
    if (isset($_SESSION['cart']['acara'][$id_acara])) {
        $_SESSION['cart']['acara'][$id_acara]['quantity'] += 1;
    }
    header("Location: keranjang.php");
    exit();
}

if (isset($_GET['decrease_acara'])) {
    $id_acara = intval($_GET['decrease_acara']);
    if (isset($_SESSION['cart']['acara'][$id_acara])) {
        $_SESSION['cart']['acara'][$id_acara]['quantity'] -= 1;
        if ($_SESSION['cart']['acara'][$id_acara]['quantity'] < 1) {
            unset($_SESSION['cart']['acara'][$id_acara]);
        }
    }
    header("Location: keranjang.php");
    exit();
}

if (isset($_GET['remove_barang'])) {
    $id_barang = intval($_GET['remove_barang']);
    if (isset($_SESSION['cart']['barang'][$id_barang])) {
        unset($_SESSION['cart']['barang'][$id_barang]);
    }
    header("Location: keranjang.php");
    exit();
}

if (isset($_GET['remove_acara'])) {
    $id_acara = intval($_GET['remove_acara']);
    if (isset($_SESSION['cart']['acara'][$id_acara])) {
        unset($_SESSION['cart']['acara'][$id_acara]);
    }
    header("Location: keranjang.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/about.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Judson:wght@700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=El Messiri:wght@400;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ek Mukta:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
</head>
<body>
    <div class="container">
        <h1 class="admin-title">Keranjang Belanja</h1>

        <?php if (empty($_SESSION['cart']['barang']) && empty($_SESSION['cart']['acara'])): ?>
            <p>Wahh.. keranjang kamu kosong nih, belanja yuk!</p><br>
            <a href="index1.php" class="buy-button">Kembali</a>
        <?php else: ?>
            <h2>Barang</h2>
            <?php if (!empty($_SESSION['cart']['barang'])): ?>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_barang = 0;
                        foreach ($_SESSION['cart']['barang'] as $item) {
                            $subtotal = $item['harga_barang'] * $item['quantity'];
                            $total_barang += $subtotal;
                            echo '<tr>';
                            echo '<td><img src="/MY_NUSANTARA/admin/uploads/' . htmlspecialchars($item['gambar_barang']) . '" alt="' . htmlspecialchars($item['nama_barang']) . '" style="max-width: 100px;"></td>';
                            echo '<td>' . htmlspecialchars($item['nama_barang']) . '</td>';
                            echo '<td>Rp ' . number_format($item['harga_barang'], 0, ",", ".") . '</td>';
                            echo '<td>';
                            echo '<a href="keranjang.php?decrease_barang=' . $item['id_barang'] . '" class="admin-link" style="font-size: 24px; padding: 5px 10px; text-decoration: none;">-</a> ';
                            echo '<span style="font-size: 18px; padding: 0 10px;">' . $item['quantity'] . '</span>';
                            echo ' <a href="keranjang.php?increase_barang=' . $item['id_barang'] . '" class="admin-link" style="font-size: 24px; padding: 5px 10px; text-decoration: none;">+</a>';
                            echo '</td>';
                            echo '<td>Rp ' . number_format($subtotal, 0, ",", ".") . '</td>';
                            echo '<td><a href="keranjang.php?remove_barang=' . $item['id_barang'] . '" onclick="return confirm(\'Hapus item ini dari keranjang?\')" class="admin-link delete-link">Hapus</a></td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr>
                            <td colspan="4" style="text-align: right;"><strong>Total Barang:</strong></td>
                            <td colspan="2"><strong>Rp <?php echo number_format($total_barang, 0, ",", "."); ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Tidak ada barang di keranjang</p>
            <?php endif; ?>

            <h2>Tiket Acara</h2>
            <?php if (!empty($_SESSION['cart']['acara'])): ?>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama Acara</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_acara = 0;
                        foreach ($_SESSION['cart']['acara'] as $item) {
                            $subtotal = $item['harga'] * $item['quantity'];
                            $total_acara += $subtotal;
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($item['nama_acara']) . '</td>';
                            echo '<td>Rp ' . number_format($item['harga'], 0, ",", ".") . '</td>';
                            echo '<td>';
                            echo '<a href="keranjang.php?decrease_acara=' . $item['id_acara'] . '" class="admin-link" style="font-size: 24px; padding: 5px 10px; text-decoration: none;">-</a> ';
                            echo '<span style="font-size: 18px; padding: 0 10px;">' . $item['quantity'] . '</span>';
                            echo ' <a href="keranjang.php?increase_acara=' . $item['id_acara'] . '" class="admin-link" style="font-size: 24px; padding: 5px 10px; text-decoration: none;">+</a>';
                            echo '</td>';
                            echo '<td>Rp ' . number_format($subtotal, 0, ",", ".") . '</td>';
                            echo '<td><a href="keranjang.php?remove_acara=' . $item['id_acara'] . '" onclick="return confirm(\'Hapus tiket ini dari keranjang?\')" class="admin-link delete-link">Hapus</a></td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr>
                            <td colspan="3" style="text-align: right;"><strong>Total Tiket:</strong></td>
                            <td colspan="2"><strong>Rp <?php echo number_format($total_acara, 0, ",", "."); ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Tidak ada tiket di keranjang</p>
            <?php endif; ?>

            <h3>Total Keseluruhan: Rp <?php echo number_format(($total_barang ?? 0) + ($total_acara ?? 0), 0, ",", "."); ?></h3><br>

            <a href="checkout.php" class="buy-button">Checkout</a><br>
            <br><br>
            <a href="index1.php" class="buy-button">Kembali</a>
            <br><br>      
        <?php endif; ?>
        <a href="pesanan.php" class="buy-button">Pesanan Anda</a>
    </div>
</body>
</html>
