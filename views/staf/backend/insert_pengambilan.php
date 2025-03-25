<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/vendor/autoload.php"); // Load library MPDF

use Mpdf\Mpdf;

session_start();
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idStaf = $_SESSION['ID_staf']; // Ambil ID staf yang sedang login

    // Ambil nama staf dari database berdasarkan ID_staf
    $queryStaf = "SELECT nama_staf FROM staf WHERE ID_staf = '$idStaf'";
    $resultStaf = $conn->query($queryStaf);

    if ($resultStaf->num_rows > 0) {
        $rowStaf = $resultStaf->fetch_assoc();
        $namaStaf = $rowStaf['nama_staf']; // Nama staf yang sedang login
    } else {
        echo json_encode(["status" => "error", "message" => "Data staf tidak ditemukan"]);
        exit();
    }

    $noSurat = $conn->real_escape_string($_POST['noSurat']);
    $tanggalDiperlukan = $conn->real_escape_string($_POST['tanggalDiperlukan']);
    $tujuan = $conn->real_escape_string($_POST['tujuan']);
    $namaBarang = $conn->real_escape_string($_POST['namaBarang']);
    $jumlah = (int) $conn->real_escape_string($_POST['jumlah']);

    // Set status otomatis
    $status = "Diproses";

    // Format tanggal dalam bahasa Indonesia
    setlocale(LC_TIME, 'id_ID.utf8', 'Indonesian_indonesia.1252');
    $tanggalSekarang = strftime('%d %B %Y');

    // Buat file PDF
    $pdfFileName = "pengambilan_" . time() . ".pdf";
    $pdfFilePath = $_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/upload/surat_pengambilan/" . $pdfFileName;
    $linkSurat = "/project_inventaris/upload/surat_pengambilan/" . $pdfFileName;

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
        <p><span class="bold">Perihal</span> : Permohonan Pengambilan Barang</p>
        <p><span class="bold">Lampiran</span> : -</p>
    </div>

    <p>Kepada Yth.</p>
    <p class="content"> <b> PT. Lintas Internasional Berkarya </b><br>
    Direktur Utama</p>
    <br>
    <p class="content">Dengan hormat,</p>
    <p class="content">
    Melalui surat ini kami sampaikan bahwa kami, dari divisi ' . $namaStaf . ' bertujuan melakukan pengambilan barang ' . $namaBarang . ' sebanyak ' . $jumlah . ' yang dibutuhkan pada tanggal ' . $tanggalDiperlukan . ' untuk keperluan ' . $tujuan . '.
    </p>

    <p class="content">Demikian kami sampaikan. Atas perhatian Bapak, kami ucapkan terima kasih.</p>

    <div class="signature">
        <p>Balikpapan, ' . $tanggalSekarang . '</p>
        <p>Hormat kami,</p>
        <br><br>
        <p> '. $namaStaf .'</p>
    </div>
    ';

    $mpdf->WriteHTML($html);
    $mpdf->Output($pdfFilePath, "F"); // Simpan PDF ke folder

    // Simpan data ke database
    $sql = "INSERT INTO surat_pengambilan (no_surat, tanggal, tujuan, nama_barang, jumlah, status, link_surat, id_staf) 
            VALUES ('$noSurat', '$tanggalDiperlukan', '$tujuan', '$namaBarang', '$jumlah', '$status', '$linkSurat', '$idStaf')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Data berhasil disimpan", "link_surat" => $linkSurat]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan data: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode tidak valid"]);
}
?>
