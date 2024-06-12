<?php
include 'config.php';

// Username dan password admin
$username = 'adminkea';
$password = password_hash('123', PASSWORD_DEFAULT);

// Query untuk memasukkan data admin ke tabel users
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

// Eksekusi query
if ($conn->query($sql) === TRUE) {
    echo "Admin berhasil ditambahkan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
