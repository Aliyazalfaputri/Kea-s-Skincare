<?php
include 'config.php';

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan ID produk dari URL
$id = $_GET['id'];

// Menghapus data produk berdasarkan ID
$sql = "DELETE FROM produk WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Produk berhasil dihapus";
    // Redirect ke halaman produk.php setelah pesan berhasil dihapus
    header("Location: produk.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
