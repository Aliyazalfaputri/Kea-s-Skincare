<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan Penjualan Juni 2024</title>
    <link rel="stylesheet" href="css/laporan.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<?php include 'template/header.php'; ?>

<div class="container">
    <?php include 'template/sidebar.php'; ?>
    <div class="content">
        <h1>Laporan Penjualan</h1>
        <form method="GET" action="">
            <div class="form-group">
                <label for="bulan">Pilih Bulan:</label>
                <select id="bulan" name="bulan">
                    <option value="">Bulan</option>
                    <!-- Add options for months -->
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tahun">Pilih Tahun:</label>
                <select id="tahun" name="tahun">
                    <option value="">Tahun</option>
                    <!-- Add options for years -->
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="search" value="month" class="btn">Cari</button>
                <button type="button" onclick="location.reload()" class="btn">Refresh</button>
                <button type="button" onclick="exportToExcel()" class="btn">Excel</button>
            </div>
        </form>

        <form method="GET" action="">
            <div class="form-group">
                <label for="tanggal">Pilih Hari:</label>
                <input type="date" id="tanggal" name="tanggal">
            </div>
            <div class="form-group">
                <button type="submit" name="search" value="day" class="btn">Cari</button>
                <button type="button" onclick="location.reload()" class="btn">Refresh</button>
                <button type="button" onclick="exportToExcel()" class="btn">Excel</button>
            </div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Modal</th>
                    <th>Total</th>
                    <th>Kasir</th>
                    <th>Tanggal Input</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'config.php';

                $query = "SELECT l.id, l.quantity, l.cashier, l.input_date, p.id as produk_id, p.nama, p.kategori, p.harga_beli, p.harga_jual
                          FROM laporan l
                          JOIN produk p ON l.produk_id = p.id
                          WHERE 1=1";

                if (isset($_GET['search'])) {
                    if ($_GET['search'] == 'month') {
                        $bulan = $_GET['bulan'];
                        $tahun = $_GET['tahun'];
                        if ($bulan && $tahun) {
                            $query .= " AND MONTH(l.input_date) = $bulan AND YEAR(l.input_date) = $tahun";
                        }
                    } elseif ($_GET['search'] == 'day') {
                        $tanggal = $_GET['tanggal'];
                        if ($tanggal) {
                            $query .= " AND l.input_date = '$tanggal'";
                        }
                    }
                }

                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $total = $row['harga_jual'] * $row['quantity'];
                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td>{$row['produk_id']}</td>";
                        echo "<td>{$row['nama']}</td>";
                        echo "<td>{$row['kategori']}</td>";
                        echo "<td>{$row['quantity']}</td>";
                        echo "<td>{$row['harga_beli']}</td>";
                        echo "<td>{$total}</td>";
                        echo "<td>{$row['cashier']}</td>";
                        echo "<td>{$row['input_date']}</td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='9'>No data available in table</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="total">
            <p>Total Terjual: 
                <?php
                $total_query = "SELECT SUM(l.quantity) as total_qty, SUM(p.harga_beli * l.quantity) as total_cost, SUM(p.harga_jual * l.quantity) as total_sales
                                FROM laporan l
                                JOIN produk p ON l.produk_id = p.id";
                $total_result = mysqli_query($conn, $total_query);
                $totals = mysqli_fetch_assoc($total_result);
                echo $totals['total_qty'];
                ?>
            </p>
            <p>Rp. <?php echo number_format($totals['total_cost'], 2, ',', '.'); ?>,-</p>
            <p>Keuntungan: Rp. <?php echo number_format($totals['total_sales'], 2, ',', '.'); ?>,-</p>
        </div>
    </div>

    <script>
        function exportToExcel() {
            // Implement export to excel functionality
        }
    </script>
</body>
</html>