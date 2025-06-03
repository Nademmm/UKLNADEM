<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_SESSION['cart']) || (empty($_SESSION['cart']['barang']) && empty($_SESSION['cart']['acara']))) {
    header('Location: keranjang.php');
    exit();
}

$user = $_SESSION['user'];
$total_barang = 0;
$total_acara = 0;

function format_rupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ",", ".");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $payment_method = htmlspecialchars($_POST['payment_method']);

    $total_amount = 0;
    if (!empty($_SESSION['cart']['barang'])) {
        foreach ($_SESSION['cart']['barang'] as $item) {
            $total_amount += $item['harga_barang'] * $item['quantity'];
        }
    }
    if (!empty($_SESSION['cart']['acara'])) {
        foreach ($_SESSION['cart']['acara'] as $item) {
            $total_amount += $item['harga'] * $item['quantity'];
        }
    }

    $user_id = $_SESSION['user']['id'] ?? null;
    $stmt = $conn->prepare("INSERT INTO orders (user_id, name, email, phone, address, payment_method, total_amount, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->bind_param("isssssd", $user_id, $name, $email, $phone, $address, $payment_method, $total_amount);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    $stmt_item = $conn->prepare("INSERT INTO order_items (order_id, product_type, product_id, product_name, quantity, price, subtotal) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!empty($_SESSION['cart']['barang'])) {
        foreach ($_SESSION['cart']['barang'] as $item) {
            $product_type = 'barang';
            $product_id = $item['id_barang'];
            $product_name = $item['nama_barang'];
            $quantity = $item['quantity'];
            $price = $item['harga_barang'];
            $subtotal = $price * $quantity;
            $stmt_item->bind_param("isisiid", $order_id, $product_type, $product_id, $product_name, $quantity, $price, $subtotal);
            $stmt_item->execute();
        }
    }
    if (!empty($_SESSION['cart']['acara'])) {
        foreach ($_SESSION['cart']['acara'] as $item) {
            $product_type = 'acara';
            $product_id = $item['id_acara'];
            $product_name = $item['nama_acara'];
            $quantity = $item['quantity'];
            $price = $item['harga'];
            $subtotal = $price * $quantity;
            $stmt_item->bind_param("isisiid", $order_id, $product_type, $product_id, $product_name, $quantity, $price, $subtotal);
            $stmt_item->execute();
        }
    }
    $stmt_item->close();
    $_SESSION['cart'] = [];
    if ($payment_method === 'ewallet') {
        header('Location: ewallet_payment.php?order_id=' . $order_id);
        exit();
    }
    $order_placed = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Checkout - MY NUSANTARA</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/about.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Judson:wght@700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ek+Mukta:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout</h1>

        <?php if (isset($order_placed) && $order_placed): ?>
            <div class="order-confirmation">
                <h2>Terima kasih atas pesanan Anda!</h2>
                <p>Pesanan Anda telah berhasil diproses.</p>
                <a href="index1.php" class="back-to-home">Kembali ke Beranda</a>
            </div>
        <?php else: ?>
            <form method="POST" action="checkout.php" class="checkout-form">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($user['nama'] ?? ''); ?>" />
                </div>
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" />
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="text" id="phone" name="phone" required />
                </div>
                <div class="form-group" style="flex: 1 1 100%;">
                    <label for="address">Alamat Pengiriman</label>
                    <textarea id="address" name="address" required></textarea>
                </div>

                <div class="cart-summary">
                    <h2>Ringkasan Pesanan</h2>
                    <?php if (!empty($_SESSION['cart']['barang'])): ?>
                        <h3>Barang</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['cart']['barang'] as $item):
                                    $subtotal = $item['harga_barang'] * $item['quantity'];
                                    $total_barang += $subtotal;
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['nama_barang']); ?></td>
                                    <td><?php echo format_rupiah($item['harga_barang']); ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td><?php echo format_rupiah($subtotal); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                    <?php if (!empty($_SESSION['cart']['acara'])): ?>
                        <h3>Tiket Acara</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama Acara</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['cart']['acara'] as $item):
                                    $subtotal = $item['harga'] * $item['quantity'];
                                    $total_acara += $subtotal;
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['nama_acara']); ?></td>
                                    <td><?php echo format_rupiah($item['harga']); ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td><?php echo format_rupiah($subtotal); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                    <table>
                        <tr class="total-row">
                            <td colspan="3" style="text-align: right;">Total Keseluruhan:</td>
                            <td><?php echo format_rupiah($total_barang + $total_acara); ?></td>
                        </tr>
                    </table>
                </div>

                <div class="payment-methods">
                    <h2>Metode Pembayaran</h2>
                    <label>
                        <input type="radio" name="payment_method" value="ewallet" required>e-wallet/Qris
                    </label>
                </div>

                <button type="submit" class="place-order-btn">Pesan Sekarang</button>
            </form>
        <?php endif; ?>
        <a href="keranjang.php" class="back-to-home">Kembali ke keranjang</a>
    </div>
</body>
</html>
