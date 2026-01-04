<?php
include '../config/conn.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    session_start();
    echo json_encode([
        'id_akun' => $_SESSION['id_akun'],
        'role' => $_SESSION['role'],
        'email' =>$_SESSION['email'],
        'username' => $_SESSION['username']
    ]);
}
?>