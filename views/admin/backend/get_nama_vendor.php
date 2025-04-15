<?php
// backend/get_nama_vendor.php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

header('Content-Type: application/json');

$query = $conn->query("SELECT nama_vendor FROM vendor");

$vendor = [];
while ($row = $query->fetch_assoc()) {
    $vendor[] = $row;
}

echo json_encode($vendor);
?>
