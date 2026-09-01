<?php
session_start();

include("../inc/inc_koneksi.php");

$error = '';

if (isset($_SESSION['admin_login']) && $_SESSION['admin_login']) {
    header("Location: halaman.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Username dan password harus diisi.';
    } else {
        $stmt = $koneksi->prepare("SELECT * FROM halaman_login WHERE username = ?");

        if ($stmt) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['password'])) {
                    $_SESSION['admin_login'] = true;
                    $_SESSION['admin_id'] = $user['id'];
                    $_SESSION['admin_username'] = $user['username'];

                    header("Location: halaman.php");
                    exit();
                } else {
                    $error = 'Password salah.';
                }
            } else {
                $error = 'Username tidak ditemukan.';
            }

            $stmt->close();
        } else {
            $error = 'Query gagal diproses.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Sekretariat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #edf4ff, #f8fafc);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 500px;
        }

        .card-header {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            color: white;
            padding: 22px 20px;
            text-align: center;
        }

        .logo-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 12px;
        }

        .logo-mark {
            width: 90px;
            height: 90px;
            display: block;
        }

        .card-body {
            padding: 28px 26px 26px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 14px;
            background: #f8fbff;
        }

        .btn-primary {
            border-radius: 12px;
            padding: 12px;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card">
                    <div class="card-header">
                        <div class="logo-wrap">
                            <svg class="logo-mark" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" aria-label="HKBP logo">
                                <circle cx="60" cy="60" r="44" fill="#0b2a7a"/>
                                <rect x="53" y="18" width="14" height="52" fill="#ffffff"/>
                                <rect x="28" y="46" width="64" height="14" fill="#ffffff"/>
                                <rect x="18" y="62" width="84" height="12" fill="#0b2a7a" rx="3"/>
                                <path d="M20 75 L100 75 L100 80 L20 80 Z" fill="#0b2a7a"/>
                                <path d="M32 88 Q60 76 88 88 L88 92 Q60 100 32 92 Z" fill="#ffffff"/>
                                <text x="60" y="106" text-anchor="middle" font-size="16" font-weight="700" fill="#ffffff" font-family="Arial, sans-serif">HKBP</text>
                            </svg>
                        </div>
                        <h3 class="mb-0">Login Admin Sekretariat</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($error !== ''): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" value="" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                            </div>

                            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                        </form>

                        <div class="text-center mt-3">
                            <small>
                                Belum punya akun? <a href="setup.php">Buat akun baru</a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
