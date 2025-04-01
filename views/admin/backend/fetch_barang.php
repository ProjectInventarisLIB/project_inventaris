<?php
// backend/fetch_barang.php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

header('Content-Type: application/json');

$query = $conn->query("SELECT ID_barang, nama_barang FROM barang");
$barang = [];
while ($row = $query->fetch_assoc()) {
    $barang[] = $row;
}

echo json_encode($barang);
?>