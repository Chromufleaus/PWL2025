<?php
header('Content-Type: application/json');
require 'db_07057.php';

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
  case 'GET':
    if (isset($_GET['id'])) {
      $id = (int)$_GET['id'];
      $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id=?");
      $stmt->bind_param('i', $id);
      $stmt->execute();
      $data = $stmt->get_result()->fetch_assoc();
      echo json_encode($data ?: []);
    } else {
      $res = $conn->query("SELECT * FROM mahasiswa");
      $out = [];
      while ($r = $res->fetch_assoc()) { $out[] = $r; }
      echo json_encode($out);
    }
    break;

  case 'POST':
    $input = json_decode(file_get_contents('php://input'), true);
    $stmt = $conn->prepare(
      "INSERT INTO mahasiswa (nim,nama,jurusan) VALUES (?,?,?)"
    );
    $stmt->bind_param(
      'sss',
      $input['nim'],
      $input['nama'],
      $input['jurusan']
    );
    $ok = $stmt->execute();
    echo json_encode(['status'=>$ok]);
    break;

  case 'PUT':
    $input = json_decode(file_get_contents('php://input'), true);
    $stmt = $conn->prepare(
      "UPDATE mahasiswa SET nim=?, nama=?, jurusan=? WHERE id=?"
    );
    $stmt->bind_param(
      'sssi',
      $input['nim'],
      $input['nama'],
      $input['jurusan'],
      $input['id']
    );
    $ok = $stmt->execute();
    echo json_encode(['status'=>$ok]);
    break;

  case 'DELETE':
    $input = json_decode(file_get_contents('php://input'), true);
    $stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id=?");
    $stmt->bind_param('i', $input['id']);
    $ok = $stmt->execute();
    echo json_encode(['status'=>$ok]);
    break;

  default:
    http_response_code(405);
    echo json_encode(['error'=>'Method Not Allowed']);
    break;
}
