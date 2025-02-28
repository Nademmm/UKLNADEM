<?php
$host = "localhost";
$user = "root"; // Ganti jika berbeda
$pass = ""; // Ganti jika memiliki password
$db = "projectukl";

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambahkan error handling untuk koneksi
if (!$conn) {
    echo "Koneksi database gagal!";
    exit();
}
?>