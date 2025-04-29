<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['ID_vendor'])) {
    $id = trim($_POST['ID_vendor']);

    // Cek apakah ID ada di database sebelum menghapus
    $checkQuery = "SELECT * FROM vendor WHERE ID_vendor = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $deleteQuery = "DELETE FROM vendor WHERE ID_vendor = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Vendor berhasil dihapus"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal menghapus vendor"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Vendor tidak ditemukan"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Permintaan tidak valid"]);
}
?>
