<?php
include '../config/conn.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kategori = $_POST['id'] ?? null;

    if (!$id_kategori) {
        echo json_encode([
            'success' => false,
            'message' => 'ID tidak ditemukan'
        ]);
        exit;
    }

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE tb_kategori SET status = 'nonaktif' WHERE id_kategori = ?"
    );
    mysqli_stmt_bind_param($stmt, "s", $id_kategori);
    mysqli_stmt_execute($stmt);

    echo json_encode([
        'success' => true,
        'message' => 'Data berhasil dihapus'
    ]);
    exit;
}
