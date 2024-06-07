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

// Mendapatkan data produk berdasarkan ID
$sql = "SELECT * FROM produk WHERE id=$id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];

    // Update data produk
    $sql = "UPDATE produk SET nama='$nama', kategori='$kategori', harga_beli='$harga_beli', harga_jual='$harga_jual', stok='$stok' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Produk berhasil diupdate";
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
    <title>Edit Produk</title>
</head>

<?php include 'template/header.php'; ?>

<body>
    <main class="container">
    <h2>Edit Produk</h2>
    <form method="post" action="">
        Nama: <input type="text" name="nama" value="<?php echo $product['nama']; ?>"><br>
        Kategori: <input type="text" name="kategori" value="<?php echo $product['kategori']; ?>"><br>
        Harga Beli: <input type="text" name="harga_beli" value="<?php echo $product['harga_beli']; ?>"><br>
        Harga Jual: <input type="text" name="harga_jual" value="<?php echo $product['harga_jual']; ?>"><br>
        Stok: <input type="text" name="stok" value="<?php echo $product['stok']; ?>"><br>
        <input type="submit" value="Update" class="update-button">
    </form>
    </main>

    <?php include 'template/footer.php'; ?>
</body>
</html>