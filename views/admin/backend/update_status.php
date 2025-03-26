<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_web/config/konfigurasi.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_surat = $_POST['no_surat'];
    $status = $_POST['status'];

    $query = "UPDATE surat_pengambilan SET status = ? WHERE no_surat = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $status, $no_surat);

    if ($stmt->execute()) {
        echo "Status berhasil diperbarui untuk No. Surat " . $no_surat;
    } else {
        echo "Gagal memperbarui status.";
    }

    $stmt->close();
    $conn->close();
}
?>