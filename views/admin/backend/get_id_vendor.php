<?php
// Sertakan file konfigurasi untuk koneksi ke database
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

$sql = "SELECT ID_vendor FROM vendor ORDER BY ID_vendor DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['lastKode' => $row['ID_vendor']]);
} else {
    echo json_encode(['lastKode' => 'VNDR000']);
}

$conn->close();
?>
