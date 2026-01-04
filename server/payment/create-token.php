<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/conn.php';

$ENV = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$ENV->load();

\Midtrans\Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;


$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

$id_pemesanan = 'ORD-' . date("Y-m-d") . "-" . random_int(1000, 9999);

$params = [
    'transaction_details' => [
        'order_id' => $id_pemesanan,
        'gross_amount' => (int) $data['total']
    ],
    'customer_details' => [
        'first_name' => 'Guest'
    ]
];

 $now = date("Y-m-d H:i:s");
 $tanggal_kepulangan = date("Y-m-d", strtotime($data['tanggal_kunjungan'] . " +{$data['durasi']} days" ));
 $stmt = mysqli_prepare($conn, "INSERT INTO tb_pemesanan VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'tunda', 'tidak')");
 mysqli_stmt_bind_param($stmt, "sssiisssii", $id_pemesanan, $data['id_akun'], $data['id_wisata'], $data['jumlah_pengunjung'], $data['durasi'] ,$data['tanggal_kunjungan'], $tanggal_kepulangan, $now, $data['harga_wisata'], $data['total']);
 mysqli_stmt_execute($stmt);
 $token = \Midtrans\Snap::getSnapToken($params);
 
echo json_encode(['token' => $token, 'id_pemesanan' => $id_pemesanan]);
