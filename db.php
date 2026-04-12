<?php
$host   = 'mysql.railway.internal';
$user   = 'root';
$pass   = 'ObrJZrhunNccQSPFzWctObbAkXHvwfjk';
$dbname = 'railway';
$port   = 3306;

$conn = mysqli_connect($host, $user, $pass, $dbname, $port);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>