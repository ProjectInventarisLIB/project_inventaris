<?php
session_start(); // Mulai sesi
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

header('Content-Type: application/json');

// Pastikan user sudah login
if (!isset($_SESSION['ID_staf'])) {
    echo json_encode(["error" => "User belum login"]);
    exit;
}

$id_staf = $_SESSION['ID_staf']; // Ambil ID staf yang login

$queries = [
    "total_pengadaan" => "SELECT COUNT(*) AS total FROM surat_pengadaan WHERE ID_staf = '$id_staf'",
    "total_peminjaman" => "SELECT COUNT(*) AS total FROM surat_pengambilan WHERE ID_staf = '$id_staf'",
    "pengadaan_disetujui" => "SELECT COUNT(*) AS total FROM surat_pengadaan WHERE status = 'Disetujui' AND ID_staf = '$id_staf'",
    "peminjaman_disetujui" => "SELECT COUNT(*) AS total FROM surat_pengambilan WHERE status = 'Disetujui' AND ID_staf = '$id_staf'"
];

$data = [];

foreach ($queries as $key => $sql) {
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $data[$key] = $row['total'];
    } else {
        $data[$key] = "Query error: " . mysqli_error($conn);
    }
}

echo json_encode($data);

mysqli_close($conn);
?>
