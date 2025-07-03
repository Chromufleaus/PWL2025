<?php
require_once __DIR__ . '/config/midtrans_07057.php';
session_start();
header('Content-Type: application/json');

// Ambil data dari session dan form
$order_id      = uniqid('ORDER-');
$gross_amount  = (int)$_POST['gross_amount'];
$customer      = [
    'first_name' => $_POST['customer_name'],
    'phone'      => $_POST['phone'],
];

// Detail item berdasarkan keranjang
$item_details = [];
foreach ($_SESSION['cart'] as $id => $qty) {
    $item_details[] = [
        'id'       => "PROD-$id",
        'price'    => $gross_amount,
        'quantity' => 1,
        'name'     => 'Pesanan #'.$order_id,
    ];
}

$params = [
    'transaction_details' => ['order_id'=> $order_id, 'gross_amount'=> $gross_amount],
    'customer_details'    => $customer,
    'item_details'        => $item_details,
];

try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    echo json_encode(['token' => $snapToken]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
