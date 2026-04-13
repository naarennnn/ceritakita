<?php
$host   = $_ENV['MYSQL_HOST'] ?? getenv('MYSQL_HOST');
$user   = $_ENV['MYSQL_USER'] ?? getenv('MYSQL_USER');
$pass   = $_ENV['MYSQL_PASSWORD'] ?? getenv('MYSQL_PASSWORD');
$dbname = $_ENV['MYSQL_DATABASE'] ?? getenv('MYSQL_DATABASE');
$port   = $_ENV['MYSQL_PORT'] ?? getenv('MYSQL_PORT') ?? 3306;

$conn = mysqli_connect($host, $user, $pass, $dbname, (int)$port);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>