<?php
// backend/insert_pengadaan.php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kodeBarang = isset($_POST['kodeBarang']) ? $conn->real_escape_string($_POST['kodeBarang']) : "";
    $noSurat = isset($_POST['noSurat']) ? $conn->real_escape_string($_POST['noSurat']) : "";
    $namaBarang = isset($_POST['namaBarang']) ? $conn->real_escape_string($_POST['namaBarang']) : "";
    $deskripsi = isset($_POST['deskripsi']) ? $conn->real_escape_string($_POST['deskripsi']) : "";
    $tanggalKeluar = isset($_POST['tanggalKeluar']) ? $conn->real_escape_string($_POST['tanggalKeluar']) : "";
    $jumlah = isset($_POST['jumlah']) ? intval($_POST['jumlah']) : 0;
    $satuan = isset($_POST['satuan']) ? $conn->real_escape_string($_POST['satuan']) : "";
    $danaFinal = isset($_POST['danaFinal']) ? floatval($_POST['danaFinal']) : 0;

    // Validasi input
    if (empty($noSurat) || empty($tanggalKeluar) || empty($jumlah) || empty($satuan) || empty($danaFinal)) {
        echo json_encode(["status" => "error", "message" => "Semua kolom harus diisi!"]);
        exit;
    }

    // Insert data ke tabel barang_pengambilan
    $sql = "INSERT INTO barang_pengadaan (ID_barang, no_surat, tanggal, nama_barang, deskripsi, jumlah_diperlukan, satuan, dana_final) 
            VALUES ('$kodeBarang', '$noSurat', '$tanggalKeluar', '$namaBarang', '$deskripsi', '$jumlah', '$satuan', '$danaFinal')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Data pengadaan berhasil disimpan!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan data: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan!"]);
}
?>
