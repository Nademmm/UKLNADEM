<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$message = '';
$inserted_order = false;

$order_id = $_GET['order_id'] ?? null;
if (!$order_id) {
    header('Location: pesanan.php?error=invalid_order_id');
    exit();
}

$order = null;
if ($order_id && isset($_SESSION['user']['id'])) {
    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $order_id, $_SESSION['user']['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    }
    $stmt->close();
}

if (isset($_POST['cancel_order'])) {
    unset($_SESSION['pending_order']);
    unset($_SESSION['cart']);
    header('Location: checkout.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['payment_proof']) && $order_id) {
    $uploadDir = __DIR__ . '/../admin/uploads/payment_proofs/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $file = $_FILES['payment_proof'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    $maxFileSize = 5 * 1024 * 1024; 

    if ($file['error'] === UPLOAD_ERR_OK) {
        if (in_array($file['type'], $allowedTypes)) {
            if ($file['size'] <= $maxFileSize) {
                $fileName = uniqid('proof_') . '_' . basename($file['name']);
                $targetFile = $uploadDir . $fileName;

                if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                    include 'connect.php';

                    $stmt = $conn->prepare("UPDATE orders SET payment_proof = ?, status = 'paid' WHERE id = ? AND user_id = ?");
                    $stmt->bind_param("sii", $fileName, $order_id, $_SESSION['user']['id']);
                    if ($stmt->execute()) {
                        $message = 'Bukti pembayaran berhasil diunggah dan pesanan Anda telah diproses.';
                        $inserted_order = true;
                    } else {
                        $message = 'Gagal memperbarui status pesanan: ' . $conn->error;
                    }
                    $stmt->close();
                } else {
                    $message = 'Gagal mengunggah file.';
                }
            } else {
                $message = 'Ukuran file terlalu besar. Maksimal 5MB.';
            }
        } else {
            $message = 'Tipe file tidak diizinkan. Hanya JPG, PNG, GIF yang diperbolehkan.';
        }
    } else {
        $message = 'Terjadi kesalahan saat mengunggah file.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pembayaran e-Wallet - MY NUSANTARA</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/pesanan.css" />
</head>
<body>
    <div class="payment-container">
        <img src="/MY_NUSANTARA/image/dana.jpg" alt="Dana" />
        <p>Silahkan scan untuk membayar pesanan anda</p>

        <?php if ($message): ?>
            <p class="upload-message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <?php if ($inserted_order): ?>
            <div class="thankyou-box">
                <h2>Terima kasih atas pembelian Anda!</h2>
                <p>Silakan unduh e-tiket Anda melalui tautan di bawah ini.</p>
                <img src="/MY_NUSANTARA/admin/uploads/barcode.jpg" alt="Barcode" style="max-width:200px; margin-bottom:40px; allign-items:center;" />
                <a href="/MY_NUSANTARA/admin/uploads/barcode.jpg" download="e-ticket.jpg" class="buy-button">Unduh E-Tiket</a>
            </div>
        <?php else: ?>
        <form action="ewallet_payment.php?order_id=<?php echo htmlspecialchars($order_id); ?>" method="post" enctype="multipart/form-data">
            <label for="payment_proof">Unggah bukti pembayaran (screenshot):</label><br/>
            <input type="file" name="payment_proof" id="payment_proof" accept="image/*" required />
            <button type="submit">Kirim Bukti Pembayaran</button>
        </form>

        <form action="ewallet_payment.php" method="post" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pembayaran?');">
            <button type="submit" name="cancel_order" class="back-link">Batalkan pembayaran</button>
        </form>
        <?php endif; ?><br>
        <a href="index1.php" class="back-link">Kembali ke Beranda</a>
    </div>
</body>
</html>
