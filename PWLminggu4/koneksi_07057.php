<?php
// koneksi_07057.php
$host   = 'localhost';
$user   = 'root';
$pass   = '';
$dbname = 'DBminggu4_07057';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// Set charset agar mendukung UTF-8
$conn->set_charset('utf8mb4');
?>