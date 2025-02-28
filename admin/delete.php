<?php
include 'config.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM users WHERE id=$id"; // Ensure $id is a valid integer

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
