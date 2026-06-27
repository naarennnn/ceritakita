<?php
$host   = 'localhost';
$user   = 'root';
$pass   = '';
$dbname = 'ceritakita';
$port   = 3306;

$conn = mysqli_connect($host, $user, $pass, $dbname, (int)$port);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>