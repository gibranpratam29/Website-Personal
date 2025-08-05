<?php
$host = "localhost";
$user = "root";
$pass = ""; // atau sesuai konfigurasi server kamu
$db   = "jadwal_sidang";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
