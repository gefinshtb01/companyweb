<?php
session_start();

include("../inc/inc_koneksi.php");
include("cek_login.php");
include("inc_header.php");
?>

<style>
    body {
        background: #f4f7fb;
    }

    .dashboard-title {
        color: #172b4d;
        font-weight: 700;
    }

    .stat-card {
        border: 0;
        border-radius: 18px;
        color: white;
        box-shadow: 0 8px 20px rgba(0,0,0,.08);
    }

    .stat-icon {
        font-size: 35px;
    }

    .card-blue {
        background: #1677ff;
    }

    .card-green {
        background: #20c997;
    }

    .card-orange {
        background: #ffb347;
    }

    .card-purple {
        background: #9b5de5;
    }

    .content-card {
        border: 0;
        border-radius: 18px;
        box-shadow: 0 5px 18px rgba(0,0,0,.06);
    }

    .logo-box {
        width: 52px;
        height: 52px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border-radius: 12px;
        margin-right: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .logo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <div class="logo-box">
                <img src="https://i0.wp.com/hkbpdistrik28deboskab.org/wp-content/uploads/2019/02/cropped-Logo-HKBP.jpg?fit=300%2C300&ssl=1" alt="Logo HKBP" />
            </div>
            <div>
                <h2 class="dashboard-title mb-0">Dashboard HKBP Poriaha Julu Ressorrt Poriaha</h2>
                <p class="text-muted mb-0">
                    Tata Usaha / Sekretaris Huria HKBP
                </p>
            </div>
        </div>

        <a href="logout.php" class="btn btn-outline-danger">
            Keluar
        </a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card card-blue p-3">
                <div class="stat-icon">👥</div>
                <h6>Jemaat Aktif</h6>
                <h2>1.284</h2>
                <small>Anggota gereja terdaftar</small>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card card-green p-3">
                <div class="stat-icon">🏘️</div>
                <h6>Wijk</h6>
                <h2>12</h2>
                <small>Wilayah jemaat aktif</small>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card card-orange p-3">
                <div class="stat-icon">📖</div>
                <h6>Sakramen</h6>
                <h2>86</h2>
                <small>Pelayanan tahun ini</small>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card card-purple p-3">
                <div class="stat-icon">💰</div>
                <h6>Keuangan</h6>
                <h2>Rp 48,7 jt</h2>
                <small>Pemasukan gereja bulan ini</small>
            </div>
        </div>
    </div>

    <div class="card content-card p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Data Gereja & Masyarakat</h4>
            <button class="btn btn-primary">Tambah Data</button>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Jemaat</th>
                        <th>Wijk</th>
                        <th>Pelayanan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Martina Sihombing</td>
                        <td>Wijk I</td>
                        <td>Tardidi</td>
                        <td><span class="badge bg-success">Aktif</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Johan Simanjuntak</td>
                        <td>Wijk II</td>
                        <td>Malua</td>
                        <td><span class="badge bg-info">Proses</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Lina Sitanggang</td>
                        <td>Wijk III</td>
                        <td>Pemberkatan Nikah</td>
                        <td><span class="badge bg-warning">Menunggu</span></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Rudi Manurung</td>
                        <td>Wijk IV</td>
                        <td>Perjamuan Kudus</td>
                        <td><span class="badge bg-secondary">Selesai</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card content-card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Ringkasan Kegiatan Gereja</h4>
            <button class="btn btn-outline-primary">Cetak Laporan</button>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="border rounded p-3 h-100">
                    <strong>Jadwal Ibadah</strong>
                    <p class="mb-0 mt-2">Minggu: 08.00 & 18.00 WIB</p>
                    <p class="mb-0">Wijk: 16.00 WIB</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border rounded p-3 h-100">
                    <strong>Parhalado</strong>
                    <p class="mb-0 mt-2">7 Pendeta/Perintis aktif</p>
                    <p class="mb-0">12 pembaca Warta Jemaat</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border rounded p-3 h-100">
                    <strong>Persembahan</strong>
                    <p class="mb-0 mt-2">Pelean Ia: Rp 12,3 jt</p>
                    <p class="mb-0">Pembangunan: Rp 9,8 jt</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("inc_footer.php"); ?>