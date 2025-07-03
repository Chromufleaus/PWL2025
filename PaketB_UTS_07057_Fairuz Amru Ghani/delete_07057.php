<?php
include 'config_07057.php';
$id = $_GET['id'];
$koneksi->query("DELETE FROM products WHERE id=$id");
header("Location: index_07057.php");
?>