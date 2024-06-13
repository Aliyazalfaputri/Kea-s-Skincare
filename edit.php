<?php
include 'config.php'; // Menghubungkan ke file config.php

// Inisialisasi variabel
$nama = $kategori = $harga_beli = $harga_jual = $stok = "";

// Memeriksa apakah ada ID di URL untuk pembaruan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data produk berdasarkan ID
    $sql = "SELECT * FROM produk WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mengisi variabel dengan data produk
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
        $kategori = $row['kategori'];
        $harga_beli = $row['harga_beli'];
        $harga_jual = $row['harga_jual'];
        $stok = $row['stok'];
    } else {
        echo "Produk tidak ditemukan.";
    }
}

// Memeriksa apakah formulir telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari formulir
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];

    // Menyimpan data ke database menggunakan koneksi dari config.php
    $sql = "UPDATE produk SET nama='$nama', kategori='$kategori', harga_beli='$harga_beli', harga_jual='$harga_jual', stok='$stok' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        // Mengarahkan ke produk.php setelah data berhasil diperbarui
        header("Location: produk.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Menutup koneksi database
    $conn->close();
}
?>

<?php include 'template/header.php'; ?>

<link rel="stylesheet" href="css/tambah.css">

<div class="container">
    <?php include 'template/sidebar.php'; ?>
    <main class="content">
        <h2 style="text-align: center; margin-bottom: 20px; color: #ff2994;">Update Produk Skincare</h2>

        <form class="add-product-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>">
            <div class="form-group">
                <label for="nama">Nama Skincare:</label>
                <input type="text" name="nama" id="nama" value="<?php echo $nama; ?>" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <input type="text" name="kategori" id="kategori" value="<?php echo $kategori; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga_beli">Harga Beli:</label>
                <input type="text" name="harga_beli" id="harga_beli" value="<?php echo $harga_beli; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga_jual">Harga Jual:</label>
                <input type="text" name="harga_jual" id="harga_jual" value="<?php echo $harga_jual; ?>" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="text" name="stok" id="stok" value="<?php echo $stok; ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Update">
            </div>
        </form>
    </main>
</div>

<?php include 'template/footer.php'; ?>
