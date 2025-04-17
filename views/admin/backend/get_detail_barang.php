<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ID_barang"])) {
    $id_barang = $conn->real_escape_string($_POST["ID_barang"]);

    // Query ambil data barang
    $query = "SELECT ID_barang, nama_barang, ukuran, jumlah_barang, satuan, gambar, tanggal, dana_final, nama_vendor FROM barang WHERE ID_barang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id_barang);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika data ditemukan
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(["status" => "error", "message" => "Data tidak ditemukan!"]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Permintaan tidak valid!"]);
}
?>
