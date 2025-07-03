<?php
require 'vendor/autoload.php';
include 'db_07057.php';

use Dompdf\Dompdf;

$key = $conn->real_escape_string($_GET['keyword'] ?? '');
$res = $conn->query("
  SELECT * FROM mahasiswa
  WHERE nim LIKE '%$key%' OR nama LIKE '%$key%'
");

$html = '<h3>Data Mahasiswa</h3><table border="1" cellpadding="5" cellspacing="0"><tr>'
      . '<th>NIM</th><th>Nama</th><th>Jurusan</th><th>Jenis Kelamin</th></tr>';

while ($r = $res->fetch_assoc()) {
  $html .= '<tr>'
        . '<td>'.$r['nim'].'</td>'
        . '<td>'.$r['nama'].'</td>'
        . '<td>'.$r['jurusan'].'</td>'
        . '<td>'.$r['jenis_kelamin'].'</td>'
        . '</tr>';
}
$html .= '</table>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4','portrait');
$dompdf->render();
$dompdf->stream("mahasiswa.pdf", ["Attachment" => true]);
exit;
?>