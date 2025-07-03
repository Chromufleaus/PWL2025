<?php
//require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/midtrans_07057.php';

\Midtrans\Config::$serverKey    = MIDTRANS_SERVER_KEY;
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized  = true;
\Midtrans\Config::$is3ds        = true;