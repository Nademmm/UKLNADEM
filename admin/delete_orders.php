<?php
session_start();
include '../beranda/connect.php';

$order_id = intval($_GET['id'] ?? 0);
if ($order_id <= 0) {
    die('ID pesanan tidak valid.');
}

$stmt_items = $conn->prepare("DELETE FROM order_items WHERE order_id = ?");
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$stmt_items->close();

$stmt_order = $conn->prepare("DELETE FROM orders WHERE id = ?");
$stmt_order->bind_param("i", $order_id);
$stmt_order->execute();
$stmt_order->close();

header("Location: orders.php?Data berhasil dihapus");
exit();
?>
