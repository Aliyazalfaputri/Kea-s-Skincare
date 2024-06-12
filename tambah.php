<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/tambah.css">
  <title>Tambah Produk</title>
</head>
<body>
  <?php include 'template/header.php'; ?>
  <main class="container">
    <h2>Tambah Produk</h2>
    <form method="post" action="" class="add-product-form">
      <div class="form-group">
        <label for="nama">Nama Skincare:</label>
        <input type="text" id="nama" name="nama" value="">
      </div>
      
      <div class="form-group">
        <label for="kategori">Kategori:</label>
        <input type="text" id="kategori" name="kategori" value="">
      </div>
      
      <div class="form-group">
        <label for="harga_beli">Harga Beli:</label>
        <input type="text" id="harga_beli" name="harga_beli" value="">
      </div>
      
      <div class="form-group">
        <label for="harga_jual">Harga Jual:</label>
        <input type="text" id="harga_jual" name="harga_jual" value="">
      </div>
      
      <div class="form-group">
        <label for="stok">Stok:</label>
        <input type="text" id="stok" name="stok" value="">
      </div>
      
      <div class="form-group">
        <input type="submit" value="Tambah">
      </div>
    </form>
  </main>
  <?php include 'template/footer.php'; ?>
</body>
</html>
