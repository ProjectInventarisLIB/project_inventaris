<?php
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'] . "/project_web/config/konfigurasi.php");

$searchTerm = isset($_GET['term']) ? mysqli_real_escape_string($conn, $_GET['term']) : '';

$query = "SELECT DISTINCT id_barang, nama_barang, jumlah_barang FROM barang";
if ($searchTerm !== '') {
    $query .= " WHERE nama_barang LIKE '%$searchTerm%'";
}
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $isDisabled = ($row['jumlah_barang'] <= 1) ? true : false;
    $data[] = [
        "id" => $row['id_barang'] . " - " . $row['nama_barang'], //jika ingin ganti yg ditampilkan dari barang yg dipilih
        "text" => $row['id_barang'] . " - " . $row['nama_barang'] . " (Stok: " . $row['jumlah_barang'] . ")",
        "disabled" => $isDisabled
    ];
}

echo json_encode($data);
?>
