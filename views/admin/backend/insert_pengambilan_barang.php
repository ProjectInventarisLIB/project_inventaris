<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggalKeluar = isset($_POST['tanggalKeluar']) ? $conn->real_escape_string($_POST['tanggalKeluar']) : '';
    $noSurat = isset($_POST['noSurat']) ? $conn->real_escape_string($_POST['noSurat']) : '';
    $data = isset($_POST['data']) ? $_POST['data'] : [];

    if (empty($tanggalKeluar) || empty($noSurat) || empty($data)) {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap."]);
        exit;
    }

    $berhasil = true;
    $pesanError = "";

    foreach ($data as $item) {
        $kodeBarang = $conn->real_escape_string($item['ID_barang']);
        $jumlah = intval($item['jumlah']);

        // Cek ketersediaan stok
        $cek = $conn->query("SELECT nama_barang, jumlah_barang FROM barang WHERE ID_barang = '$kodeBarang'");
        if ($cek->num_rows > 0) {
            $row = $cek->fetch_assoc();

            if ($row['jumlah_barang'] < $jumlah) {
                $berhasil = false;
                $pesanError = "Stok barang tidak mencukupi untuk ID: $kodeBarang.";
                break;
            }

            $namaBarang = $row['nama_barang'];

            // Kurangi stok barang
            $conn->query("UPDATE barang SET jumlah_barang = jumlah_barang - $jumlah WHERE ID_barang = '$kodeBarang'");

            // Simpan ke tabel barang_pengambilan, hanya menyimpan no_surat, ID_barang, nama_barang, jumlah_diambil
            $sql = "INSERT INTO barang_pengambilan (ID_barang, nama_barang, tanggal, jumlah_diambil, no_surat) 
                    VALUES ('$kodeBarang', '$namaBarang', '$tanggalKeluar', '$jumlah', '$noSurat')";
            if (!$conn->query($sql)) {
                $berhasil = false;
                $pesanError = "Gagal insert barang: " . $conn->error;
                break;
            }
        } else {
            $berhasil = false;
            $pesanError = "Barang dengan ID $kodeBarang tidak ditemukan.";
            break;
        }
    }

    if ($berhasil) {
        // Update status surat jadi "Selesai"
        $conn->query("UPDATE surat_pengambilan SET status = 'Selesai' WHERE no_surat = '$noSurat'");
        echo json_encode(["status" => "success", "message" => "Data berhasil disimpan dan status surat diperbarui!"]);
    } else {
        echo json_encode(["status" => "error", "message" => $pesanError]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan!"]);
}
?>
