<?php
include 'config.php';

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data produk
$sql_produk = "SELECT id, nama, harga_jual FROM produk";
$result_produk = $conn->query($sql_produk);

// Memproses data saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'];
    $item_count = count($_POST['id_produk']);

    for ($i = 0; $i < $item_count; $i++) {
        $id_produk = $_POST['id_produk'][$i];
        $jumlah = $_POST['jumlah'][$i];
        $harga = $_POST['harga'][$i];
        $total_harga = $jumlah * $harga;

        // Menyimpan data penjualan ke tabel penjualan
        $sql_penjualan = "INSERT INTO penjualan (tanggal, id_produk, jumlah, harga, total_harga) VALUES ('$tanggal', '$id_produk', '$jumlah', '$harga', '$total_harga')";

        if (!$conn->query($sql_penjualan)) {
            echo "Error: " . $sql_penjualan . "<br>" . $conn->error;
        }
    }
    echo "Transaksi berhasil dicatat";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Penjualan</title>
    <link rel="stylesheet" href="css/penjualan.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'template/header.php'; ?>

    <div class="container">
        <?php include 'template/sidebar.php'; ?>
        <main class="content">
            <h2>Catat Penjualan</h2>
            <form method="post" action="">
                <div id="items">
                    <div class="item">
                        <label for="id_produk">Produk:</label>
                        <select name="id_produk[]" class="id_produk" onchange="updateHarga(this)" required>
                            <option value="" data-harga="0">Pilih Produk</option>
                            <?php
                            if ($result_produk->num_rows > 0) {
                                while($row = $result_produk->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "' data-harga='" . $row['harga_jual'] . "'>" . $row['nama'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Tidak ada produk</option>";
                            }
                            ?>
                        </select><br>

                        <label for="jumlah">Jumlah:</label>
                        <input type="number" name="jumlah[]" class="jumlah" oninput="updateTotal(this)" required><br>

                        <label for="harga">Harga:</label>
                        <input type="text" name="harga[]" class="harga" readonly required><br>

                        <label for="total_harga">Total Harga:</label>
                        <input type="text" name="total_harga[]" class="total_harga" readonly required><br>
                    </div>
                </div>
                <button type="button" onclick="addItem()">Tambah Barang</button><br>

                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" required><br>

                <input type="submit" value="Catat Penjualan">
            </form>
        </main>
    </div>

    <?php include 'template/footer.php'; ?>

    <script>
        function updateHarga(select) {
            const harga = select.options[select.selectedIndex].getAttribute('data-harga');
            const item = select.closest('.item');
            item.querySelector('.harga').value = harga;
            updateTotal(select);
        }

        function updateTotal(input) {
            const item = input.closest('.item');
            const jumlah = item.querySelector('.jumlah').value;
            const harga = item.querySelector('.harga').value;
            item.querySelector('.total_harga').value = jumlah * harga;
        }

        function addItem() {
            const itemTemplate = document.querySelector('.item').cloneNode(true);
            itemTemplate.querySelectorAll('input').forEach(input => input.value = '');
            document.getElementById('items').appendChild(itemTemplate);
        }
    </script>
</body>
</html>
