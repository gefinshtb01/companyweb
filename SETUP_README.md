# Setup Admin Login - Website Company Project

## 🚀 Quick Start (Recommended)

### Cara 1: Auto Setup (Paling Mudah) ⭐
1. Buka browser: **`http://localhost/Website_Company_Project/admin/create_table.php`**
2. Halaman akan otomatis:
   - ✓ Membuat tabel `halaman_login`
   - ✓ Membuat akun admin default
3. Redirect ke login page
4. Gunakan kredensial: **admin / admin123**

---

### Cara 2: Manual Setup via phpMyAdmin

1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Pilih database: **`companyweb`**
3. Buka tab **SQL**
4. Copy & paste isi dari file: **`create_halaman_login_table.sql`**
5. Klik "Markahi kueri SQL ini" atau Ctrl+Enter
6. Selesai!

---

## 📝 Kredensial Default

- **Username:** `admin`
- **Password:** `admin123`

⚠️ **PENTING:** Ubah password default setelah login pertama kali!

---

## 🔐 Struktur Tabel

```sql
CREATE TABLE halaman_login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

---

## 📂 File-File Setup

- **create_table.php** - Auto create tabel & akun default
- **create_halaman_login_table.sql** - SQL script manual
- **setup.php** - Halaman untuk membuat akun baru
- **halaman_input.php** - Login page
- **halaman.php** - Admin dashboard (setelah login)

---

## ✅ Checklist Setup

- [ ] Database `companyweb` sudah dibuat
- [ ] Koneksi ke database berhasil (`inc_koneksi.php` sudah benar)
- [ ] Jalankan `http://localhost/Website_Company_Project/admin/create_table.php`
- [ ] Login ke `http://localhost/Website_Company_Project/admin/halaman_input.php`
- [ ] Username: **admin**, Password: **admin123**
- [ ] Setup berhasil! 🎉

---

## 🔧 Troubleshooting

### Error: "Table doesn't exist"
→ Jalankan `create_table.php` untuk auto-create tabel

### Error: "Connection failed"
→ Periksa `inc_koneksi.php`, pastikan host, user, password, dan database sudah benar

### Lupa password admin
→ Masuk phpMyAdmin, buka tabel `halaman_login`, edit password dengan hash baru
