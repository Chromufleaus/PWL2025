<?php
require 'vendor/autoload.php';
include 'db_07057.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$key = $conn->real_escape_string($_GET['keyword'] ?? '');
$res = $conn->query("
  SELECT * FROM mahasiswa
  WHERE nim LIKE '%$key%' OR nama LIKE '%$key%'
");

$ss = new Spreadsheet();
$sh = $ss->getActiveSheet();
$sh->fromArray(['NIM','Nama','Jurusan','Jenis Kelamin'], NULL, 'A1');

$row = 2;
while ($r = $res->fetch_assoc()) {
  $sh->setCellValue("A{$row}", $r['nim'])
     ->setCellValue("B{$row}", $r['nama'])
     ->setCellValue("C{$row}", $r['jurusan'])
     ->setCellValue("D{$row}", $r['jenis_kelamin']);
  $row++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="mahasiswa.xlsx"');

$writer = new Xlsx($ss);
$writer->save('php://output');
exit;
?>