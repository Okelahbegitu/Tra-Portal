<?php
include '../config/conn.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_wisata = $_POST['id'] ?? null;

    if (!$id_wisata) {
        echo json_encode([
            'success' => false,
            'message' => 'ID tidak ditemukan'
        ]);
        exit;
    }

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE tbwisata SET status = 'nonaktif' WHERE id_wisata = ?"
    );
    mysqli_stmt_bind_param($stmt, "s", $id_wisata);
    mysqli_stmt_execute($stmt);

    echo json_encode([
        'success' => true,
        'message' => 'Data berhasil dihapus'
    ]);
    exit;
}
