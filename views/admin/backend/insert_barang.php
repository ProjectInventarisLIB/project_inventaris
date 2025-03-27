<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_barang = $_POST["id_barang"];
    $nama_barang = $_POST["namaBarang"];
    $jumlah_barang = $_POST["jumlahBarang"];
    $ukuran = $_POST["ukuranBarang"];

    // Pastikan ada file yang diupload
    if (!isset($_FILES["gambarBarang"]) || $_FILES["gambarBarang"]["error"] !== UPLOAD_ERR_OK) {
        echo json_encode(["status" => "error", "message" => "File gambar tidak ditemukan atau terjadi kesalahan!"]);
        exit;
    }

    // Proses Upload Gambar
    $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/upload/gambar_barang/";
    $fileName = basename($_FILES["gambarBarang"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Validasi jenis file
    $allowedTypes = ['jpg', 'jpeg', 'png'];
    if (!in_array($fileType, $allowedTypes)) {
        echo json_encode(["status" => "error", "message" => "Format gambar tidak didukung!"]);
        exit;
    }

    // Cek apakah direktori upload ada, jika tidak buat baru
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Pindahkan file ke folder upload
    if (move_uploaded_file($_FILES["gambarBarang"]["tmp_name"], $targetFilePath)) {
        // Simpan ke database
        $query = "INSERT INTO barang (id_barang, nama_barang, jumlah_barang, ukuran, gambar) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("ssiss", $id_barang, $nama_barang, $jumlah_barang, $ukuran, $fileName);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Data berhasil disimpan!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Gagal menyimpan data ke database!"]);
            }

            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Query gagal disiapkan!"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal mengunggah gambar!"]);
    }
}
?>
