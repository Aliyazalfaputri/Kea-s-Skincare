<?php
include 'config.php';

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan data produk
$sql = "SELECT id, nama, kategori, harga_beli, harga_jual, stok FROM produk";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kea's Skincare - Produk</title>
    <link rel="stylesheet" href="css/produk.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'template/header.php'; ?>

    <main class="container">
        <h2>Data Produk</h2>
        <button class="insert-btn"><a href="tambah.php">Tambah Data</a></button>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data dari setiap baris
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["kategori"] . "</td>";
                        echo "<td>" . $row["harga_beli"] . "</td>";
                        echo "<td>" . $row["harga_jual"] . "</td>";
                        echo "<td>" . $row["stok"] . "</td>";
                        echo "<td class='action-buttons'>";
                        echo "<button class='mod-btn'><a href='edit.php?id=" . $row["id"] . "'>Edit</a></button>";
                        echo "<button class='mod-btn'><a href='hapus.php?id=" . $row["id"] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk ini?\")'>Hapus</a></button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

    <?php include 'template/footer.php'; ?>
</body>
</html>
