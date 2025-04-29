<?php
// Sertakan file konfigurasi untuk koneksi ke database
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

$sql = "SELECT ID_barang FROM barang_pengadaan ORDER BY ID_barang DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['lastKode' => $row['ID_barang']]);
} else {
    echo json_encode(['lastKode' => 'BRGPGDN000']);
}

$conn->close();
?>
