<?php
include("../inc/inc_koneksi.php");

$message = '';
$status = '';

// Buat tabel jika belum ada
$create_table_query = "CREATE TABLE IF NOT EXISTS halaman_login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";

if($koneksi->query($create_table_query)) {
    $message = "✓ Tabel berhasil dibuat!";
    $status = 'success';
    
    // Cek apakah sudah ada admin
    $check_query = "SELECT COUNT(*) as count FROM halaman_login";
    $result = $koneksi->query($check_query);
    $row = $result->fetch_assoc();
    
    if($row['count'] == 0) {
        // Buat akun default
        $username = 'admin';
        $password = password_hash('admin123', PASSWORD_BCRYPT);
        $email = 'admin@companyweb.com';
        
        $insert_query = "INSERT INTO halaman_login (username, password, email) VALUES (?, ?, ?)";
        $stmt = $koneksi->prepare($insert_query);
        $stmt->bind_param("sss", $username, $password, $email);
        
        if($stmt->execute()) {
            $message .= "<br>✓ Akun default berhasil dibuat!<br>";
            $message .= "<strong>Username:</strong> admin<br>";
            $message .= "<strong>Password:</strong> admin123";
        }
        $stmt->close();
    }
} else {
    $message = "Error: " . $koneksi->error;
    $status = 'error';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup - Company Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Database Setup</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-<?php echo $status == 'success' ? 'success' : 'danger'; ?>">
                            <?php echo $message; ?>
                        </div>
                        
                        <div class="text-center">
                            <a href="halaman_input.php" class="btn btn-primary">Lanjut ke Login →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
