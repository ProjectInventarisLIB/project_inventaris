<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

header('Content-Type: application/json');

$sql = "SELECT ID_staf, nama_staf, email_staf, pengeluaran_anggaran, anggaran FROM staf";
$result = mysqli_query($conn, $sql);

$stafData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $stafData[] = [
        "ID_staf" => $row['ID_staf'],
        "nama_staf" => $row['nama_staf'],
        "email_staf" => $row['email_staf'],
        "pengeluaran_anggaran" => $row['pengeluaran_anggaran'],
        "anggaran" => $row['anggaran']
    ];
}

echo json_encode($stafData);

mysqli_close($conn);
?>
