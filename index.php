<?php
include 'config.php';

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan jumlah tipe barang (jumlah produk unik)
$sql_types = "SELECT COUNT(DISTINCT id) AS jumlah_tipe FROM produk";
$result_types = $conn->query($sql_types);
$row_types = $result_types->fetch_assoc();
$jumlah_tipe = $row_types['jumlah_tipe'];

// Query untuk mendapatkan total stok barang dari semua produk
$sql_stock = "SELECT SUM(stok) AS total_stok FROM produk";
$result_stock = $conn->query($sql_stock);
$row_stock = $result_stock->fetch_assoc();
$total_stok = $row_stock['total_stok'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kea's Skincare - Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include 'template/header.php'; ?>

    <main class="container">
        <h2>Dashboard</h2>
        <div class="dashboard-info">
            <div class="info-box">
                <h3><a href="produk.php">Jumlah Tipe Barang</a></h3>
                <div class="info-content">
                    <p><?php echo $jumlah_tipe; ?></p>
                </div>
            </div>
            <div class="info-box">
                <h3><a href="produk.php">Stok Barang</a></h3>
                <div class="info-content">
                    <p><?php echo $total_stok; ?></p>
                </div>
            </div>
            <div class="info-box">
                <h3>Barang Terjual</h3>
                <div class="info-content">
                    <!-- <p><?php echo $total_terjual; ?></p> -->
                </div>
            </div>
        </div>
    </main>

    <?php include 'template/footer.php'; ?>
</body>
</html>
