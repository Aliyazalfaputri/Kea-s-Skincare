<?php
include 'config.php';

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Inisialisasi variabel input
$nama = $kategori = $harga_beli = $harga_jual = $stok = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];

    // Insert data produk
    $sql = "INSERT INTO produk (nama, kategori, harga_beli, harga_jual, stok) VALUES ('$nama', '$kategori', '$harga_beli', '$harga_jual', '$stok')";

    if ($conn->query($sql) === TRUE) {
        echo "Produk berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
</head>

<?php include 'template/header.php'; ?>

<body>
    <main class="container">
    <h2>Tambah Produk</h2>
    <form method="post" action="">
        Nama: <input type="text" name="nama" value="<?php echo $nama; ?>"><br>
        Kategori: <input type="text" name="kategori" value="<?php echo $kategori; ?>"><br>
        Harga Beli: <input type="text" name="harga_beli" value="<?php echo $harga_beli; ?>"><br>
        Harga Jual: <input type="text" name="harga_jual" value="<?php echo $harga_jual; ?>"><br>
        Stok: <input type="text" name="stok" value="<?php echo $stok; ?>"><br>
        <input type="submit" value="Tambah">
    </form>
    </main>

    <?php include 'template/footer.php'; ?>
</body>
</html>