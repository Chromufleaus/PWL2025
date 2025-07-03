<?php
// koneksi ke database kampus_07057
$host     = 'localhost';
$user     = 'root';
$pass     = '';
$database = 'kampus_07057';

$conn = new mysqli($host, $user, $pass, $database);
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>