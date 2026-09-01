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
    <title>Login Jemaat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-left: #ffffff;
            --field-bg: #dfeaf6;
            --field-border: #b9d5ef;
            --primary-green: #1e9e58;
            --primary-yellow: #f4b512;
            --button-dark: #5f5855;
            --text-dark: #2b2b2b;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            min-height: 100%;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #ffffff;
        }

        body {
            min-height: 100vh;
        }

        .login-shell {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        .login-panel {
            flex: 1 1 50%;
            background: var(--bg-left);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 50px;
        }

        .login-box {
            width: 100%;
            max-width: 470px;
        }

        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-mark {
            width: 150px;
            height: 150px;
            margin: 0 auto 18px;
            display: block;
            border-radius: 50%;
            object-fit: cover;
            background: rgba(255,255,255,0.75);
            padding: 10px;
            border: 5px solid #f3b00f;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .brand h1 {
            margin: 0;
            font-size: clamp(2.2rem, 2vw, 3rem);
            font-weight: 400;
            letter-spacing: 0.03em;
            color: var(--text-dark);
        }

        form {
            width: 100%;
        }

        .field-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 1.1rem;
            color: var(--text-dark);
            font-weight: 500;
        }

        input {
            width: 100%;
            height: 54px;
            border-radius: 12px;
            border: 2px solid var(--field-border);
            background: var(--field-bg);
            padding: 0 16px;
            color: var(--text-dark);
            font-size: 1.05rem;
            transition: 0.2s ease;
        }

        input::placeholder {
            color: rgba(35, 35, 35, 0.65);
        }

        input:focus {
            outline: none;
            border-color: #6caed8;
            box-shadow: 0 0 0 4px rgba(108, 174, 216, 0.2);
            background: #eaf4ff;
        }

        .alert {
            margin-bottom: 18px;
            border-radius: 12px;
        }

        .login-btn {
            width: 100%;
            height: 58px;
            border: none;
            border-radius: 12px;
            background: #5b564f;
            color: #fff;
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            cursor: pointer;
            margin-top: 8px;
            transition: opacity 0.2s ease;
        }

        .login-btn:hover {
            opacity: 0.96;
        }

        .image-panel {
            flex: 1 1 50%;
            position: relative;
            background-image: url('https://images.unsplash.com/photo-1522926193341-e9ffd686c60f?auto=format&fit=crop&w=1200&q=80');
            background-position: center center;
            background-size: cover;
            min-height: 100vh;
        }

        .image-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(51, 48, 46, 0.28);
        }

        @media (max-width: 900px) {
            .login-shell {
                flex-direction: column;
            }

            .login-panel,
            .image-panel {
                flex: 1 1 100%;
                min-height: 50vh;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="login-shell">
        <section class="login-panel">
            <div class="login-box">
                <div class="brand">
                    <img
                        class="brand-mark"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQ_7QrvpL0wXgk4SyysKpHzIG_RSlXansP5iOeRvv8Dg&s"
                        alt="Logo Jemaat"
                        style="object-fit: contain; border-radius: 50%; background: rgba(255,255,255,0.55); padding: 8px;"
                    >
                    <h1>LOGIN JEMAAT</h1>
                </div>

                <?php if ($error !== ''): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="field-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="adminjemaat" value="" required>
                    </div>

                    <div class="field-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="********" required>
                    </div>

                    <button type="submit" name="login" class="login-btn">MASUK</button>
                </form>
            </div>
        </section>

        <aside class="image-panel" aria-label="Background image"></aside>
    </div>
</body>
</html>
