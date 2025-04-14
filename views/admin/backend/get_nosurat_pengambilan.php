<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

header('Content-Type: application/json');

$query = $conn->query("SELECT id_pengambilan, no_surat, tanggal FROM surat_pengambilan WHERE status = 'Disetujui'");
$surat = [];
while ($row = $query->fetch_assoc()) {
    $surat[] = $row;
}

echo json_encode($surat);

?>