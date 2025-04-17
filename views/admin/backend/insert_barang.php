<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_barang = $_POST["id_barang"];
    $nama_barang = $_POST["namaBarang"];
    $jumlah_barang = $_POST["jumlahBarang"];
    $satuan = $_POST["satuan"];
    $ukuran = $_POST["ukuranBarang"];
    $tanggalMasuk = $_POST["tanggal"];
    $dana_final = $_POST["dana_final"];
    $namaVendor = $_POST["namaVendor"];
    
    $fileName = "default_barang.jpg"; // Gambar default
    
    // Cek apakah ada file yang diupload
    if (isset($_FILES["gambarBarang"]) && $_FILES["gambarBarang"]["error"] === UPLOAD_ERR_OK) {
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
        if (!move_uploaded_file($_FILES["gambarBarang"]["tmp_name"], $targetFilePath)) {
            echo json_encode(["status" => "error", "message" => "Gagal mengunggah gambar!"]);
            exit;
        }
    }
    
    // Simpan ke database
    $query = "INSERT INTO barang (id_barang, nama_barang, jumlah_barang, satuan, ukuran, gambar, tanggal, dana_final, nama_vendor) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("ssissssis", $id_barang, $nama_barang, $jumlah_barang, $satuan, $ukuran, $fileName, $tanggalMasuk, $dana_final, $namaVendor);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Data berhasil disimpan!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal menyimpan data ke database!"]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Query gagal disiapkan!"]);
    }
}
?>
