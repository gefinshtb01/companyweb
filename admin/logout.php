<?php
// filepath: c:\Users\ASUS\Documents\Website_Company_Project\admin\logout.php
session_start();

$_SESSION = [];
session_destroy();

header("Location: halaman_input.php");
exit();