<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/conn.php';
include '../../config/conn.php';

$ENV = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$ENV->load();

\Midtrans\Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;



$notif = new \Midtrans\Notification();


$order_id = $notif->order_id;

$status = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;

$Fstatus;
$stmt = mysqli_prepare($conn, "UPDATE tb_pemesanan SET status = ? WHERE id_pemesanan = ?");



if ($status == 'capture') {
    if ($type == 'credit_card') {
        if ($fraud == 'accept') {
            // TODO set payment status in merchant's database to 'Success'
            echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
        }
    }
} else if ($status == 'settlement') {
    // TODO set payment status in merchant's database to 'Settlement'
    echo "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
    $Fstatus = "lunas";
} else if ($status == 'pending') {
    // TODO set payment status in merchant's database to 'Pending'
    echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
    $Fstatus = "tunda";

} else if ($status == 'deny' || $transaction == 'cancel' || $status == 'expire') {
    // TODO set payment status in merchant's database to 'Denied, cancel, or expire'
    echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
    $Fstatus = "batal";
}
mysqli_stmt_bind_param($stmt, "ss", $Fstatus, $order_id);
mysqli_execute($stmt);
?>