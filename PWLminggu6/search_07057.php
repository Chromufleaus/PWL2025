<?php
header('Content-Type: application/json');
include 'db_07057.php';

$key = $conn->real_escape_string($_GET['keyword'] ?? '');
$sql = "SELECT * FROM mahasiswa
        WHERE nim   LIKE '%$key%'
           OR nama  LIKE '%$key%'";
$res = $conn->query($sql);

$out = [];
while ($r = $res->fetch_assoc()) {
  $out[] = $r;
}
echo json_encode($out);
?>