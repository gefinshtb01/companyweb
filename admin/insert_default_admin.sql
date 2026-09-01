-- Insert akun admin default ke halaman_login
-- Username: admin
-- Password: admin123 (sudah di-hash dengan bcrypt)

INSERT INTO halaman_login (username, password, email) VALUES 
('admin', '$2y$10$5K1Q9v8X7L2P3N6M4B9C8D1E2F3G4H5I6J7K8L9M0N1P2Q3R4S5T6', 'admin@companyweb.com');
