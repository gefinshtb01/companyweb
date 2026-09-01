<?php
include("../inc/inc_koneksi.php");

// Cek apakah ada data admin
$check_query = "SELECT COUNT(*) as count FROM halaman_login";
$result = $koneksi->query($check_query);
$row = $result->fetch_assoc();

if ($row['count'] == 0) {
    // Tidak ada data, buat akun default
    $username = 'admin';
    $password = password_hash('admin123', PASSWORD_BCRYPT);
    $email = 'admin@companyweb.com';

    $insert_query = "INSERT INTO halaman_login (username, password, email) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($insert_query);
    $stmt->bind_param("sss", $username, $password, $email);

    if ($stmt->execute()) {
        echo "✓ Akun default berhasil dibuat!<br>";
        echo "Username: <strong>admin</strong><br>";
        echo "Password: <strong>admin123</strong><br>";
        echo "Email: <strong>admin@companyweb.com</strong><br><br>";
        echo "<a href='halaman_input.php' class='btn btn-primary'>Lanjut ke Login →</a>";
    }
    $stmt->close();
} else {
    echo "Akun sudah terbuat. <a href='halaman_input.php'>Ke halaman login →</a>";
}
?>