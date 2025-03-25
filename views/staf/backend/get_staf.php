<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/project_web/config/konfigurasi.php");

header('Content-Type: application/json');

// Pastikan ada sesi login
if (!isset($_SESSION['ID_staf'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$id_staf = $_SESSION['ID_staf']; // Ambil ID staf yang benar

$sql = "SELECT nama_staf, email_staf, pengeluaran_anggaran, anggaran FROM staf WHERE ID_staf = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id_staf);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode([
        "nama_staf" => $row['nama_staf'],
        "nama_staf1" => $row['nama_staf'],
        "email_staf" => $row['email_staf'],
        "email_staf1" => $row['email_staf'],
        "pengeluaran_anggaran" => $row['pengeluaran_anggaran'],
        "pengeluaran_anggaran1" => $row['pengeluaran_anggaran'],
        "anggaran" => $row['anggaran'],
        "anggaran1" => $row['anggaran']
    ]);
} else {
    echo json_encode(["error" => "Data not found"]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
