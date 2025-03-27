<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

// Ambil ID terakhir dari database
$queryLastID = "SELECT id_barang FROM barang WHERE id_barang LIKE '25BRG%' ORDER BY id_barang DESC LIMIT 1";
$resultLastID = $conn->query($queryLastID);

if ($resultLastID->num_rows > 0) {
    $row = $resultLastID->fetch_assoc();
    preg_match('/25BRG(\d{3})/', $row['id_barang'], $matches);
    $lastNumber = isset($matches[1]) ? (int)$matches[1] + 1 : 1;
} else {
    $lastNumber = 1;
}

// Format ID barang baru
$idBarangBaru = sprintf("25BRG%03d", $lastNumber);

// Mengembalikan ID barang dalam format JSON untuk digunakan di input otomatis
echo json_encode(["id_barang" => $idBarangBaru]);
?>
