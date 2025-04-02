<?php
// backend/fetch_surat.php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

header('Content-Type: application/json');

$query = $conn->query("SELECT no_surat, ID_barang, nama_barang, jumlah  FROM surat_pengambilan WHERE status = 'Disetujui'");
$surat = [];
while ($row = $query->fetch_assoc()) {
    $surat[] = $row;
}

echo json_encode($surat);
?>