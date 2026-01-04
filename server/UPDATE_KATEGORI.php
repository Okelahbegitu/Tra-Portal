<?php
include '../config/conn.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $newData = $_POST['newData'] ?? null;

    if (!$id || !$newData) {
        echo json_encode([
            'success' => false,
            'message' => 'ID tidak ditemukan'
        ]);
        exit;
    }

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE tb_kategori SET nama_kategori = ? WHERE id_kategori = ?"
    );
    mysqli_stmt_bind_param($stmt, "ss",$newData ,$id);
    mysqli_stmt_execute($stmt);

    echo json_encode([
        'success' => true,
        'message' => 'Data berhasil diubah'
    ]);
    exit;
}
