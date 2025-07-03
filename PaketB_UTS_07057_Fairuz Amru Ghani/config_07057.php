<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'crud_db_07057';

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

// Check connection

if (!$koneksi) {

    die("Connection failed: " . mysqli_connect_error());
}
?>