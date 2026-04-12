<?php
$host   = getenv('${{MySQL.MYSQLHOST}}');
$user   = getenv('${{MySQL.MYSQLUSER}}');
$pass   = getenv('${{MySQL.MYSQLPASSWORD}}');
$dbname = getenv('${{MySQL.MYSQLDATABASE}}');
$port   = getenv('${{MySQL.MYSQLPORT}}') ?: 3306;

$conn = mysqli_connect($host, $user, $pass, $dbname, $port);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>