<?php
$host    = "localhost";
$user    = "root";
$pass    = "";
$db      = "companyweb";


$koneksi = new mysqli("localhost", "root", "", "companyweb");

if ($koneksi->connect_error) {
    die("Koneksi database gagal.");
}

// Jangan gunakan echo "Koneksi berhasil";