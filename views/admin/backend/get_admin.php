<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

header('Content-Type: application/json');

// Pastikan ada sesi login
if (!isset($_SESSION['ID_admin'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$id_admin = $_SESSION['ID_admin'];

$sql = "SELECT nama_admin, email_admin FROM admin WHERE ID_admin = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id_admin);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode([
        "nama_admin" => $row['nama_admin'],
        "email_admin" => $row['email_admin']
    ]);
} else {
    echo json_encode(["error" => "Data not found"]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
