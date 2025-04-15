<?php
// backend/insert_pengadaan.php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

header('Content-Type: application/json'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idVendor = isset($_POST['idVendor']) ? $conn->real_escape_string($_POST['idVendor']) : "";
    $namaVendor = isset($_POST['namaVendor']) ? $conn->real_escape_string($_POST['namaVendor']) : "";
    $noTelepon = isset($_POST['noTelepon']) ? $conn->real_escape_string($_POST['noTelepon']) : "";
    $alamatVendor = isset($_POST['alamatVendor']) ? $conn->real_escape_string($_POST['alamatVendor']) : "";

    // Validasi input
    if (empty($namaVendor) || empty($noTelepon) || empty($alamatVendor)) {
        echo json_encode(["status" => "error", "message" => "Semua kolom harus diisi!"]);
        exit;
    }

    // Insert data ke tabel vendor_pengadaan
    $sql = "INSERT INTO vendor (ID_vendor, nama_vendor, alamat_vendor, no_telepon) 
            VALUES ('$idVendor', '$namaVendor', '$alamatVendor', '$noTelepon')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Data vendor berhasil disimpan."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan data: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan!"]);
}
?>
