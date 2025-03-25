<?php
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'] . "/project_web/config/konfigurasi.php");

$query = "SELECT status, COUNT(*) as jumlah FROM (
    SELECT status FROM surat_pengadaan
    UNION ALL
    SELECT status FROM surat_pengambilan
  ) AS combined
  WHERE status IN ('Diproses', 'Disetujui', 'Ditolak')
  GROUP BY status";

$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[$row['status']] = (int) $row['jumlah'];
}

$conn->close();

echo json_encode($data);
?>