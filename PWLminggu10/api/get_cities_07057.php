<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/rajaongkir_07057.php';

if (!isset($_GET['province_id'])) {
    echo json_encode(['error' => 'province_id tidak disediakan']);
    exit;
}

$province = (int)$_GET['province_id'];
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => RAJAONGKIR_BASE_URL . 'city?province=' . $province,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ["key: " . RAJAONGKIR_API_KEY],
]);

$response = curl_exec($curl);
curl_close($curl);
echo $response;
