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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Reset CSS untuk menghilangkan margin dan padding bawaan browser */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: montserrat, sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

main {
    flex: 1;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0px;
}

.container-header {
    margin-left: 10px;
}

.container h2 {
    color: #6420AA;
    margin-top: 80px;
}

header {
    background-color: #ffc8e4;
    position: fixed;
    padding: 10px 0;
    height: 80px;
    width: 100%;
    box-shadow: 0px 1px 3px #ff2994;
    z-index: 1000;
    display: flex;
    align-items: center; /* Ensure vertical alignment */
}

.header-content {
    display: flex;
    align-items: center;
    width: 100%;
    justify-content: space-between; /* Distribute space between brand and nav */
}

.brand {
    color: rgba(100, 32, 170, 0.5);
    text-align: left;
    margin-left: 20px; /* Add some margin to the left if needed */
    font-family: Gilroy;
    font-size: 25px;
}

nav ul {
    display: flex;
    list-style: none;
    margin-right: 20px; /* Add some margin to the right if needed */
}

nav ul li {
    margin-left: 20px;
}

nav ul li a {
    color: #ff2994;
    text-decoration: none;
}

.dashboard-info {
    display: flex;
    justify-content: space-between;
    margin-top: 120px;
}

.info-content {
    background-color: #f4f4f4;
    
}

.info-content p {
    font-size: 24px;
    font-weight: bold;
    border-radius: 0 0 50px 50px;
}

.info-box {
    background-color: #FF69B4;
    width: 30%;
    text-align: center;
    border-radius: 10px;
}

.info-box h3 {
    margin-top: 15px;
    margin-bottom: 15px;
    color: #f4f4f4;
}

.info-box p {
    font-size: 40px;
    font-weight: bold;
    color: #6420AA;
    background-color: #ffc8e4;
    padding: 25px;
}

.info-box a {
    color: #f4f4f4;
    text-decoration: none;
}

.info-box a:hover {
    text-decoration: underline;
}

/* CSS tambahan untuk memastikan konten tabel rata tengah */
table {
    width: 100%;
    border-collapse: collapse;
}

th {
    padding: 10px;
    text-align: center; /* Nama kolom rata tengah */
}

td {
    padding: 10px;
    text-align: center; /* Konten tabel rata tengah */
    vertical-align: middle;
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.insert-btn a {
    text-decoration: none;
    color: inherit;
}

footer {
    font-size: 13px;
    color: #FF69B4;
    text-align: center;
    padding: 10px 0;
    margin-top: auto;
}

.sidebar {
    width: 250px;
    background-color: #ff99cc;
    color: #fff;
    padding: 20px;
    height: calc(100vh - 60px); /* Adjust according to header height */
    position: fixed;
    top: 80px; /* Adjust according to header height */
    left: 0;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin: 10px 0;
}

.sidebar ul li a {
    color: #fff;
    text-decoration: none;
    display: block;
    padding: 10px;
    transition: background 0.3s;
}

.sidebar ul li a:hover {
    background-color: #ff66b2;
}

.content {
    margin-left: 270px; /* Adjust according to sidebar width */
    padding: 20px;
    margin-top: 100px; /* Adjust according to header height */
    flex: 1;
    background-color: #f4f4f4;
}

.profile {
    display: flex;
    align-items: center;
    margin-right: 0px;
    padding-left: 1200px;
}

.profile i {
    font-size: 36px;
    color: #ff2994;
    margin-right: 10px;
}

.profile-text {
    display: flex;
    flex-direction: column;
    text-align: left;
}

.profile-text strong {
    font-size: 14px;
    color: #ff2994;
}

.profile-text .status {
    font-size: 12px;
    color: rgba(255, 41, 148, 0.7);
}
    </style>
</head>

<body>
    <?php include 'template/header.php'; ?>
    
    <div class="container">
        <?php include 'template/sidebar.php'; ?>
        <main class="content">
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
    </div>

    <?php include 'template/footer.php'; ?>
</body>
</html>