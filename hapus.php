<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

$id = $_GET['id'];
$sql = "DELETE FROM produk WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Produk berhasil dihapus";
    header("Location: produk.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
