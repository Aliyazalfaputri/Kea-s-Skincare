<?php
include 'config.php'; // Menghubungkan ke file config.php

// Memeriksa apakah formulir telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari formulir
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];

    // Menyimpan data ke database menggunakan koneksi dari config.php
    $sql = "INSERT INTO produk (nama, kategori, harga_beli, harga_jual, stok) VALUES ('$nama', '$kategori', '$harga_beli', '$harga_jual', '$stok')";
    
    if ($conn->query($sql) === TRUE) {
        // Mengarahkan ke produk.php setelah data berhasil ditambahkan
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

<main class="container">

<h2 style="text-align: center; margin-bottom: 20px; color : #ff2994;">Tambah Produk Skincare</h2>

  <form class="add-product-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">
      <label for="nama">Nama Skincare:</label>
      <input type="text" name="nama" id="nama" required>
    </div>
    <div class="form-group">
      <label for="kategori">Kategori:</label>
      <input type="text" name="kategori" id="kategori" required>
    </div>
    <div class="form-group">
      <label for="harga_beli">Harga Beli:</label>
      <input type="text" name="harga_beli" id="harga_beli" required>
    </div>
    <div class="form-group">
      <label for="harga_jual">Harga Jual:</label>
      <input type="text" name="harga_jual" id="harga_jual" required>
    </div>
    <div class="form-group">
      <label for="stok">Stok:</label>
      <input type="text" name="stok" id="stok" required>
    </div>
    <div class="form-group">
      <input type="submit" value="Submit">
    </div>
  </form>
</main>

<?php include 'template/footer.php'; ?>


