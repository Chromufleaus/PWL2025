<?php
// Ganti placeholder berikut dengan kunci sesungguhnya
define('MIDTRANS_SERVER_KEY', 'ISI_DENGAN_SERVER_KEY_ANDA');
define('MIDTRANS_CLIENT_KEY', 'ISI_DENGAN_CLIENT_KEY_ANDA');

// Autoload composer
require_once __DIR__ . '/../vendor/autoload.php';

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = MIDTRANS_SERVER_KEY;
\Midtrans\Config::$clientKey = MIDTRANS_CLIENT_KEY;
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;
