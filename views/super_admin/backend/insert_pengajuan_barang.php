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

    // Ambil ID staf dari tabel surat_pengadaan berdasarkan no_surat
    $getStafSql = "SELECT id_staf FROM surat_pengadaan WHERE no_surat = '$noSurat'";
    $result = $conn->query($getStafSql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idStaf = $row['id_staf'];

        // Ambil anggaran dan pengeluaran saat ini
        $getAnggaranSql = "SELECT anggaran, pengeluaran_anggaran FROM staf WHERE id_staf = '$idStaf'";
        $resultAnggaran = $conn->query($getAnggaranSql);

        if ($resultAnggaran->num_rows > 0) {
            $rowAnggaran = $resultAnggaran->fetch_assoc();
            $anggaran = floatval($rowAnggaran['anggaran']);
            $pengeluaranSaatIni = floatval($rowAnggaran['pengeluaran_anggaran']);
            $totalSetelahPenambahan = $pengeluaranSaatIni + $danaFinal;

            // Cek apakah total pengeluaran akan melebihi anggaran
            if ($totalSetelahPenambahan > $anggaran) {
                echo json_encode(["status" => "error", "message" => "Gagal: Pengeluaran melebihi anggaran yang tersedia!"]);
                exit;
            }

            // Insert data ke tabel barang_pengadaan
            $sql = "INSERT INTO barang_pengadaan (ID_barang, no_surat, tanggal, nama_barang, deskripsi, jumlah_diperlukan, satuan, dana_final) 
                    VALUES ('$kodeBarang', '$noSurat', '$tanggalKeluar', '$namaBarang', '$deskripsi', '$jumlah', '$satuan', '$danaFinal')";
            
            if ($conn->query($sql) === TRUE) {
                // Update status di tabel surat_pengadaan
                $updateStatusSql = "UPDATE surat_pengadaan SET status = 'Selesai' WHERE no_surat = '$noSurat'";
                $conn->query($updateStatusSql);

                // Mengurangi anggaran dari tabel staf dan menambahkan dana final ke pengeluaran_anggaran
                $updateAnggaranSql = "UPDATE staf SET pengeluaran_anggaran = '$totalSetelahPenambahan' WHERE id_staf = '$idStaf'";
                if ($conn->query($updateAnggaranSql) === TRUE) {
                    echo json_encode(["status" => "success", "message" => "Data pengadaan berhasil disimpan dan status surat diubah menjadi Selesai! Anggaran staf berhasil diperbarui."]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Gagal memperbarui anggaran staf: " . $conn->error]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Gagal menyimpan data: " . $conn->error]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal mengambil data anggaran staf."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "No surat tidak ditemukan di tabel surat_pengadaan."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan!"]);
}
?>
