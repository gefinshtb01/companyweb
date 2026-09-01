<?php
// filepath: c:\Users\ASUS\Documents\Website_Company_Project\admin\setup.php
session_start();
include("../inc/inc_koneksi.php");

$pesan = "";
$tipe = "";

$koneksi->query("
    CREATE TABLE IF NOT EXISTS halaman_login (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )
");

if (isset($_POST['daftar'])) {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $konfirmasi = $_POST['konfirmasi'] ?? '';

    if ($username === "" || $password === "" || $konfirmasi === "") {
        $pesan = "Semua kolom wajib diisi.";
        $tipe = "danger";
    } elseif ($password !== $konfirmasi) {
        $pesan = "Konfirmasi password tidak cocok.";
        $tipe = "danger";
    } elseif (strlen($password) < 6) {
        $pesan = "Password minimal 6 karakter.";
        $tipe = "danger";
    } else {
        $cek = $koneksi->prepare(
            "SELECT id FROM halaman_login WHERE username = ?"
        );
        $cek->bind_param("s", $username);
        $cek->execute();

        if ($cek->get_result()->num_rows > 0) {
            $pesan = "Username sudah terdaftar.";
            $tipe = "danger";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $koneksi->prepare(
                "INSERT INTO halaman_login (username, password) VALUES (?, ?)"
            );
            $stmt->bind_param("ss", $username, $hash);

            if ($stmt->execute()) {
                $pesan = "Pendaftaran berhasil. Silakan login.";
                $tipe = "success";
            } else {
                $pesan = "Pendaftaran gagal.";
                $tipe = "danger";
            }

            $stmt->close();
        }

        $cek->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-primary d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow border-0 rounded-4 p-4" style="max-width:430px;width:100%">
        <h3 class="text-center mb-2">Daftar Akun Baru</h3>
        <p class="text-center text-muted">Company Web</p>

        <?php if ($pesan !== ""): ?>
            <div class="alert alert-<?= $tipe ?>">
                <?= htmlspecialchars($pesan) ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="konfirmasi" class="form-control" required>
            </div>

            <button type="submit" name="daftar" class="btn btn-light w-100">
                Daftar Sekarang
            </button>
        </form>

        <a href="halaman_input.php" class="text-center mt-3">
            Sudah punya akun? Login
        </a>
    </div>
</body>
</html>