<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNamaStaf = $_POST['idNamaStaf'];
    $nilaiAnggaranBaru = $_POST['nilaiAnggaran'];
    $periodeAnggaran = $_POST['periodeAnggaran'];

    // Ambil ID dari format "ID - Nama Staf"
    $idStaf = explode(' - ', $idNamaStaf)[0];

    // Ambil anggaran dan pengeluaran lama untuk hitung sisa
    $sqlGetStaf = "SELECT anggaran, pengeluaran_anggaran FROM staf WHERE ID_staf = ?";
    $stmtGet = $conn->prepare($sqlGetStaf);
    $stmtGet->bind_param("s", $idStaf);
    $stmtGet->execute();
    $result = $stmtGet->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sisaAnggaran = $row['anggaran'] - $row['pengeluaran_anggaran'];
        $totalAnggaran = $sisaAnggaran + $nilaiAnggaranBaru;

        // Update tabel staf dengan total anggaran baru dan reset pengeluaran
        $sqlUpdateStaf = "UPDATE staf 
                          SET anggaran = ?, periode_anggaran = ?, pengeluaran_anggaran = 0 
                          WHERE ID_staf = ?";
        $stmt1 = $conn->prepare($sqlUpdateStaf);
        $stmt1->bind_param("iss", $totalAnggaran, $periodeAnggaran, $idStaf);

        if ($stmt1->execute()) {
            // Insert histori anggaran
            $sqlInsertAnggaran = "INSERT INTO anggaran (ID_staf, tanggal_edit, nominal_anggaran, pengeluaran_anggaran, periode_anggaran)
                                  VALUES (?, NOW(), ?, 0, ?)";
            $stmt2 = $conn->prepare($sqlInsertAnggaran);
            $stmt2->bind_param("sds", $idStaf, $totalAnggaran, $periodeAnggaran);

            if ($stmt2->execute()) {
                echo json_encode(["status" => "success", "message" => "Anggaran berhasil diperbarui dan histori disimpan."]);
            } else {
                echo json_encode(["status" => "warning", "message" => "Update staf berhasil, tapi gagal menyimpan histori."]);
            }

            $stmt2->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal memperbarui data staf."]);
        }

        $stmt1->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Data staf tidak ditemukan."]);
    }

    $stmtGet->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan."]);
}
?>
