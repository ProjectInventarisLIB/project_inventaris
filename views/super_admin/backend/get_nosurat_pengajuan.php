<?php
// backend/fetch_surat.php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

header('Content-Type: application/json');

$query = $conn->query("SELECT no_surat, nama_barang, deskripsi, jumlah, satuan, anggaran FROM surat_pengadaan WHERE status = 'Disetujui'");
$surat = [];
while ($row = $query->fetch_assoc()) {
    $surat[] = $row;
}

echo json_encode($surat);
?>
