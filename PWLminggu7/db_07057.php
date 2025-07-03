<?php
// koneksi ke database kampus_api_07057
$host     = 'localhost';
$user     = 'root';
$pass     = '';
$database = 'kampus_api_07057';

$conn = new mysqli($host, $user, $pass, $database);
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error'=>'Koneksi gagal: '.$conn->connect_error]));
}
$conn->set_charset('utf8mb4');
?>
