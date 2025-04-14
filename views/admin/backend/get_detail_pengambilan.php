<?php
// backend/get_detail_pengambilan.php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

header('Content-Type: application/json');

$id_pengambilan = $_GET['id_pengambilan'];

$stmt = $conn->prepare("SELECT id_pengambilan, ID_barang, nama_barang, jumlah FROM detail_pengambilan WHERE id_pengambilan = ?");
$stmt->bind_param("s", $id_pengambilan);
$stmt->execute();
$result = $stmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

echo json_encode($items);
?>