<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

// Cek apakah parameter ID dikirim
if (isset($_GET['id'])) {
    $idStaf = $_GET['id'];

    // Query untuk ambil data history anggaran berdasarkan ID staf
    $query = "SELECT ID_staf, tanggal_edit, nominal_anggaran, pengeluaran_anggaran, periode_anggaran FROM anggaran WHERE ID_staf = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $idStaf);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Kembalikan sebagai JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Jika ID tidak disediakan
    http_response_code(400);
    echo json_encode(array("error" => "Parameter ID tidak ditemukan."));
}
?>
