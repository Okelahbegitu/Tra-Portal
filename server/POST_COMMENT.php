<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config/conn.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);

    if (!$data) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON']);
        exit;
    }

    $history = [];
    mysqli_begin_transaction($conn);

    try {
        $id_rate = "R-" . date("Y-m-d") . "-" . random_int(1000, 9999);

        // INSERT rating
        $stmt = mysqli_prepare($conn, "
        INSERT INTO tb_rate
        VALUES (?, ?, ?, ?, ?)
    ");
        mysqli_stmt_bind_param(
            $stmt,
            "ssssi",
            $id_rate,
            $data['id_akun'],
            $data['id_wisata'],
            $data['Comment'],
            $data['rating']
        );
        mysqli_stmt_execute($stmt);

        // UPDATE pemesanan
        $stmt = mysqli_prepare($conn, "
        UPDATE tb_pemesanan 
        SET kunjungan_habis = 'ya' 
        WHERE id_pemesanan = ?
    ");
        mysqli_stmt_bind_param($stmt, "s", $data['id_pemesanan']);
        mysqli_stmt_execute($stmt);

        // SEMUA BERHASIL
        mysqli_commit($conn);

    } catch (Exception $e) {
        // ADA YANG GAGAL
        mysqli_rollback($conn);
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Gagal menyimpan rating'
        ]);
        exit;
    }

    echo json_encode(['status' => $data['id_pemesanan']]);
}
?>