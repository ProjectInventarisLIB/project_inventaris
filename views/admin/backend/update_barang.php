<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_barang = $_POST["edit_id"];
    $nama_barang = $_POST["edit_nama_barang"];
    $ukuran = $_POST["edit_ukuran"];
    $jumlah_barang = $_POST["edit_jumlah_barang"];
    $satuan = $_POST["edit_satuan"];
    $tanggal = $_POST["edit_tanggal"];
    $dana_final = $_POST["edit_dana_final"];
    $gambar_lama = $_POST["editFileName"]; // Nama file lama

    $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/upload/gambar_barang/";
    $fileName = $gambar_lama; // Default pakai gambar lama

    // Jika ada gambar baru diunggah
    if (!empty($_FILES["editGambarBarang"]["name"])) {
        $fileName = basename($_FILES["editGambarBarang"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Validasi jenis file
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        if (!in_array($fileType, $allowedTypes)) {
            echo json_encode(["status" => "error", "message" => "Format gambar tidak didukung!"]);
            exit;
        }
        

        // Pindahkan file ke folder upload
        if (move_uploaded_file($_FILES["editGambarBarang"]["tmp_name"], $targetFilePath)) {
            // Hapus gambar lama jika ada dan berbeda dari default
            if (!empty($gambar_lama) && file_exists($targetDir . $gambar_lama) && $gambar_lama !== $fileName) {
                unlink($targetDir . $gambar_lama);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal mengunggah gambar baru!"]);
            exit;
        }
    }

    // Update data barang di database
    $query = "UPDATE barang SET nama_barang = ?, ukuran = ?, jumlah_barang = ?,  satuan = ?, gambar = ?, tanggal = ?, dana_final = ? WHERE ID_barang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssisssis", $nama_barang, $ukuran, $jumlah_barang, $satuan, $fileName, $tanggal, $dana_final, $id_barang);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Data berhasil diperbarui!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal memperbarui data!"]);
    }

    $stmt->close();
}
?>
