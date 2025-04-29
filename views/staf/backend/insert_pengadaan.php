<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/vendor/autoload.php"); // Load library MPDF

use Mpdf\Mpdf;

session_start(); // Mulai session untuk mendapatkan ID staf yang login
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idStaf = $_SESSION['ID_staf']; // ID staf yang sedang login

    $queryStaf = "SELECT nama_staf FROM staf WHERE ID_staf = '$idStaf'";
    $resultStaf = $conn->query($queryStaf);

    if ($resultStaf->num_rows > 0) {
        $rowStaf = $resultStaf->fetch_assoc();
        $namaStaf = $rowStaf['nama_staf'];
    } else {
        echo json_encode(["status" => "error", "message" => "Data staf tidak ditemukan"]);
        exit();
    }

    $noSurat = $conn->real_escape_string($_POST['noSurat']);
    $tanggalDiperlukan = $conn->real_escape_string($_POST['tanggalDiperlukan']);
    $tujuan = $conn->real_escape_string($_POST['tujuan']);
    $namaBarang = $conn->real_escape_string($_POST['namaBarang']);
    $anggaran = (float) $conn->real_escape_string($_POST['anggaran']); 
    $jumlah = (int) $conn->real_escape_string($_POST['jumlah']);
    $satuan = $conn->real_escape_string($_POST['satuan']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    

    // Cek anggaran staf sebelum mengurangi
    $queryCekAnggaran = "SELECT anggaran, pengeluaran_anggaran FROM staf WHERE id_staf = '$idStaf'";
    $resultCekAnggaran = $conn->query($queryCekAnggaran);
    
    if ($resultCekAnggaran->num_rows > 0) {
        $row = $resultCekAnggaran->fetch_assoc();
        $anggaranStaf = (float) $row['anggaran'];
        $pengeluaranStaf = isset($row['pengeluaran_anggaran']) ? (float) $row['pengeluaran_anggaran'] : 0;
        
        $sisaAnggaran = $anggaranStaf - $pengeluaranStaf;
    
        if ($sisaAnggaran < $anggaran) {
            echo json_encode(["status" => "error", "message" => "Anggaran tidak mencukupi! Sisa anggaran: Rp " . number_format($sisaAnggaran, 2, ',', '.')]);
            exit;
        }
    } else {
        echo json_encode(["status" => "error", "message" => "ID staf tidak ditemukan!"]);
        exit;
    }

    // Set status otomatis
    $status = "Diproses";

    // Format tanggal dalam bahasa Indonesia
    setlocale(LC_TIME, 'id_ID.utf8', 'Indonesian_indonesia.1252');
    $tanggalSekarang = strftime('%d %B %Y');

    // Buat file PDF
    $pdfFileName = "surat_pengadaan_" . str_replace("/", "-", $noSurat) . ".pdf";
    $pdfFilePath = $_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/upload/surat_pengadaan/" . $pdfFileName;
    $linkSurat = "/project_inventaris/upload/surat_pengadaan/" . $pdfFileName;

    $mpdf = new Mpdf();

    $html = '
    <style>
        body { font-family: "Times New Roman", Times, serif; font-size: 12pt; }
        .header { text-align: left; margin-bottom: 20px; }
        .content { text-align: justify; }
        .signature { margin-top: 50px; text-align: left; }
        .bold { font-weight: bold; }
    </style>

    <div class="header">
        <p><span class="bold">Nomor</span> : ' . $noSurat . '</p>
        <p><span class="bold">Perihal</span> : Permohonan Pengajuan Barang</p>
        <p><span class="bold">Lampiran</span> : -</p>
    </div>

    <p>Kepada Yth.</p>
    <p class="content"> <b> PT. Lintas Internasional Berkarya </b><br>
    Direktur Utama</p>
    <br>
    <p class="content">Dengan hormat,</p>
    <p class="content">
    Melalui surat ini kami sampaikan bahwa kami, dari divisi ' . $namaStaf . ' ingin mengajukan pengadaan barang ' . $namaBarang . ' (' . $deskripsi . ') sebanyak ' . $jumlah .' '. $satuan . ' yang dibutuhkan pada tanggal ' . $tanggalDiperlukan . ' dengan perkiraan anggaran mencapai  Rp. ' . number_format($anggaran, 2, ',', '.') . ' adapun barang ini ditujukan untuk keperluan ' . $tujuan . '.
    </p>

    <p class="content">Demikian kami sampaikan. Atas perhatian Bapak, kami ucapkan terima kasih.</p>

    <div class="signature">
        <p>Balikpapan, ' . $tanggalSekarang . '</p>
        <p>Hormat kami,</p>
        <br><br>
        <p>' . $namaStaf . '</p>
    </div>';


    $mpdf->WriteHTML($html);
    $mpdf->Output($pdfFilePath, "F"); // Simpan PDF ke folder

    // Simpan data ke database
    $sql = "INSERT INTO surat_pengadaan (no_surat, tanggal, tujuan, nama_barang, anggaran, jumlah, satuan, deskripsi, status, link_surat, id_staf)
            VALUES ('$noSurat', '$tanggalDiperlukan', '$tujuan', '$namaBarang', '$anggaran', '$jumlah', '$satuan', '$deskripsi', '$status', '$linkSurat', '$idStaf')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Data berhasil disimpan", "link_surat" => $linkSurat]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan data: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode tidak valid"]);
}
?>
