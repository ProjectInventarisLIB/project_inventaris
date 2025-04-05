<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

header('Content-Type: application/json');

// Pastikan ada sesi login
if (!isset($_SESSION['ID_admin_utama'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$id_admin_utama = $_SESSION['ID_admin_utama'];

$sql = "SELECT nama_admin_utama, email_admin_utama FROM admin_utama WHERE ID_admin_utama = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id_admin_utama);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode([
        "nama_admin_utama" => $row['nama_admin_utama'],
        "email_admin_utama" => $row['email_admin_utama']
    ]);
} else {
    echo json_encode(["error" => "Data not found"]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
