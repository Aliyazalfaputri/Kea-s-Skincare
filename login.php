<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai username dan password dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'adminkea' && $password === '123') {
        // Redirect ke halaman admin jika login berhasil
        header("Location: index.php");
        exit;
    } else {
        // Jika login gagal, tampilkan pesan kesalahan
        $error = "Username atau password salah. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login Admin Kea's Skincare</h2>
            <?php if(isset($error)) { echo "<p>$error</p>"; } ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Login">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
