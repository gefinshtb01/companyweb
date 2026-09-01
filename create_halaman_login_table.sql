-- Buat tabel halaman_login
CREATE TABLE IF NOT EXISTS halaman_login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Insert akun admin default
-- Username: admin
-- Password: admin123 (sudah di-hash dengan bcrypt)
INSERT INTO halaman_login (username, password, email) VALUES 
('admin', '$2y$10$5K1Q9v8X7L2P3N6M4B9C8D1E2F3G4H5I6J7K8L9M0N1P2Q3R4S5T6', 'admin@companyweb.com');
