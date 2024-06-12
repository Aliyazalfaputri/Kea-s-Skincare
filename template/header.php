<?php
include 'config.php';
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
<header>
        <div class="container-header">
            <h1 class="brand">Kea's Skincare</h1>
            <nav>
                <!-- <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="produk.php">Produk</a></li>
                    <li><a href="penjualan.php">Penjualan</a></li>
                    <li><a href="laporan.php">Laporan</a></li>
                </ul> -->
            </nav>
        </div>
        <div class="profile">
                <i class="fas fa-user-circle"></i>
                <div class="profile-text">
                    <strong>Admin</strong>
                    <span class="status">available</span>
                </div>
            </div>
    </header>
    </body>

</html>
