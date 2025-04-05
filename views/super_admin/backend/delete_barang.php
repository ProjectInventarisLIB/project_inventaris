<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_web/config/konfigurasi.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['ID_barang'])) {
    $id = trim($_POST['ID_barang']);

    // Cek apakah ID ada di database sebelum menghapus
    $checkQuery = "SELECT * FROM barang WHERE ID_barang = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $id); // Gunakan "s" untuk VARCHAR
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika barang ditemukan, lakukan penghapusan
        $deleteQuery = "DELETE FROM barang WHERE ID_barang = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Barang berhasil dihapus"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal menghapus barang"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Barang tidak ditemukan"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Permintaan tidak valid"]);
}
?>
