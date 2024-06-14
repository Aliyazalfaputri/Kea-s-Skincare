<?php
include 'config.php';

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Username dan password admin
$username = 'adminkea';
$password = password_hash('123', PASSWORD_DEFAULT);

// Cek apakah username sudah ada
$sql_check = "SELECT * FROM users WHERE username = '$username'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows == 0) {
    // Query untuk memasukkan data admin ke tabel users
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    // Eksekusi query
    $conn->query($sql);
}

// Tutup koneksi
$conn->close();

// Redirect to index.php
header("Location: index.php");
exit();
?>
