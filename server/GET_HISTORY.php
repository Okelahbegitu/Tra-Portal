<?php
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
    $now = "2026-01-21";
    $Historystmt = mysqli_prepare($conn, "SELECT * FROM tb_pemesanan WHERE status = 'lunas' AND kunjungan_habis = 'tidak' AND tanggal_kepulangan = ? AND id_akun = ?");
    mysqli_stmt_bind_param($Historystmt, "ss", $now, $data['id_akun']);
    mysqli_execute($Historystmt);
    $HistoryResult = mysqli_stmt_get_result($Historystmt);

    while ($row = mysqli_fetch_assoc($HistoryResult)) {
        $history[] = $row;
    }

    echo json_encode(['id_wisata' => $history[0]['id_wisata'], 'id_pemesanan' => $history[0]['id_pemesanan']]);
}
?>