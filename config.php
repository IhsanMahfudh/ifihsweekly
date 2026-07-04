<?php
// config.php - Koneksi ke database MySQL

$host = "localhost";
$user = "root";      // ganti sesuai user MySQL kamu
$pass = "";          // ganti sesuai password MySQL kamu
$dbname = "informatika_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
