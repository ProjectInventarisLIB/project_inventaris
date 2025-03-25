<?php
session_start(); // Mulai session
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'] . "/project_web/config/konfigurasi.php");

// Cek apakah user sudah login dan memiliki ID_staf
if (!isset($_SESSION['ID_staf']) || empty($_SESSION['ID_staf'])) {
    echo json_encode(["error" => "Akses ditolak! ID Staf tidak ditemukan atau kosong."]);
    exit;
}

$id_staf = $_SESSION['ID_staf']; // Ambil ID staf yang login

// Debug: Cetak ID staf untuk memastikan ada isinya
// Uncomment jika perlu debugging
// echo json_encode(["debug_ID_staf" => $id_staf]); 
// exit;

// Query untuk menghitung jumlah status surat_pengadaan dan surat_pengambilan berdasarkan ID_staf
$query = "SELECT status, COUNT(*) as jumlah FROM (
    SELECT status FROM surat_pengadaan WHERE ID_staf = ?
    UNION ALL
    SELECT status FROM surat_pengambilan WHERE ID_staf = ?
  ) AS combined
  WHERE status IN ('Disetujui', 'Diproses', 'Ditolak')
  GROUP BY status";

// Gunakan prepared statement untuk menghindari SQL Injection
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $id_staf, $id_staf);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[$row['status']] = (int) $row['jumlah'];
}

// Tutup koneksi
$stmt->close();
$conn->close();

// Kirim data dalam format JSON
echo json_encode($data);
?>
