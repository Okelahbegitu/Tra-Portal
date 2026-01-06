<?php
include '../config/conn.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'PSOT') {

    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);

    $id_akun = $_SESSION['id_akun'];

    $Verifystmt = mysqli_prepare($conn, "SELECT password WHERE id_akun = ?");
    mysqli_stmt_bind_param($Verifystmt, "s", $id_akun);
    mysqli_stmt_execute($Verifystmt);

    $Verifyresult = mysqli_stmt_get_result($stmt);
    $verfiy = [];


    while ($row = mysqli_fetch_assoc($Verifyresult)) {
        $verfiy[] = $row;
    }

    if ($_POST['VerifyPassword'] == $verfiy[0]['password']) {

        $stmt = mysqli_prepare($conn, "UPDATE tb_akun SET username = ?, email = ?, password = ? WHERE id_akun = ?");
        mysqli_stmt_bind_param($stmt, "sss", $_POST['newUsername'], $_POST['newEmail'], $id_akun);
        mysqli_stmt_execute($stmt);
        http_response_code(201);
        echo json_encode(['respond' => 'Berhasil diperbarui!']);
    } else {
        http_response_code(404);
        echo json_encode(['respond' => 'Pastikan password sudah benar']);
        exit;
    }
}