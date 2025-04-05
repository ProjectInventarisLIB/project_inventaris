<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNamaStaf = $_POST['idNamaStaf'];
    $nilaiAnggaran = $_POST['nilaiAnggaran'];
    $periodeAnggaran = $_POST['periodeAnggaran'];

    // Memisahkan ID Staf dari string "ID - Nama Staf"
    $idStaf = explode(' - ', $idNamaStaf)[0];

    $sql = "UPDATE staf SET anggaran = ?, periode_anggaran = ?, pengeluaran_anggaran = 0 WHERE ID_staf = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $nilaiAnggaran, $periodeAnggaran, $idStaf);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Anggaran berhasil diperbarui dan pengeluaran direset."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal memperbarui anggaran."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan."]);
}
?>
