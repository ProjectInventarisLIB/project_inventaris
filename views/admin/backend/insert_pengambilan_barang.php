<?php
// backend/insert_pengambilan.php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kodeBarang = isset($_POST['kodeBarang']) ? $conn->real_escape_string($_POST['kodeBarang']) : "";
    $namaBarang = isset($_POST['namaBarang']) ? $conn->real_escape_string($_POST['namaBarang']) : "";
    $tanggalKeluar = isset($_POST['tanggalKeluar']) ? $conn->real_escape_string($_POST['tanggalKeluar']) : "";
    $jumlah = isset($_POST['jumlah']) ? intval($_POST['jumlah']) : 0;
    $noSurat = isset($_POST['noSurat']) ? $conn->real_escape_string($_POST['noSurat']) : "";
    
    if (empty($kodeBarang) || empty($tanggalKeluar) || empty($jumlah) || empty($noSurat)) {
        echo json_encode(["status" => "error", "message" => "Semua kolom harus diisi!"]);
        exit;
    }
    
    // Periksa apakah jumlah barang mencukupi
    $queryCek = $conn->query("SELECT jumlah_barang FROM barang WHERE ID_barang = '$kodeBarang'");
    if ($queryCek->num_rows > 0) {
        $row = $queryCek->fetch_assoc();
        if ($row['jumlah_barang'] < $jumlah) {
            echo json_encode(["status" => "error", "message" => "Jumlah barang tidak mencukupi!"]);
            exit;
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Barang tidak ditemukan!"]);
        exit;
    }
    
    // Kurangi jumlah barang dari tabel barang
    $conn->query("UPDATE barang SET jumlah_barang = jumlah_barang - $jumlah WHERE ID_barang = '$kodeBarang'");
    
    // Insert data ke tabel barang_pengambilan
    $sql = "INSERT INTO barang_pengambilan (ID_barang, nama_barang, tanggal, jumlah_diambil, no_surat) 
            VALUES ('$kodeBarang', '$namaBarang', '$tanggalKeluar', '$jumlah', '$noSurat')";
    
    if ($conn->query($sql) === TRUE) {
        // Update status di tabel surat_pengambilan
        $updateStatusSql = "UPDATE surat_pengambilan SET status = 'Selesai' WHERE no_surat = '$noSurat'";
        $conn->query($updateStatusSql);
        
        echo json_encode(["status" => "success", "message" => "Data pengambilan berhasil disimpan dan status surat diubah menjadi Selesai!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan data: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan!"]);
}
?>
