<?php
session_start(); // Tambahkan session_start() di awal
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/vendor/autoload.php"); // Load library MPDF

// Cek apakah user sudah login
if (!isset($_SESSION['ID_staf'])) {
    echo "Akses ditolak! Silakan login terlebih dahulu.";
    exit;
}

$id_staf = $_SESSION['ID_staf']; // Ambil ID staf yang login

// Ambil data dari tabel surat_pengadaan berdasarkan ID staf
$query1 = "SELECT * FROM surat_pengadaan WHERE ID_staf = '$id_staf'";
$result1 = $conn->query($query1);

// Ambil data dari tabel surat_pengambilan berdasarkan ID staf
$query2 = "SELECT * FROM surat_pengambilan WHERE ID_staf = '$id_staf'";
$result2 = $conn->query($query2);

// Hitung jumlah status pada surat_pengadaan
$count_pengadaan = ['Diproses' => 0, 'Disetujui' => 0, 'Ditolak' => 0];
while ($row = $result1->fetch_assoc()) {
    $count_pengadaan[ucfirst($row['status'])]++;
}

// Hitung jumlah status pada surat_pengambilan
$count_pengambilan = ['Diproses' => 0, 'Disetujui' => 0, 'Ditolak' => 0];
while ($row = $result2->fetch_assoc()) {
    $count_pengambilan[ucfirst($row['status'])]++;
}

$mpdf = new \Mpdf\Mpdf();

// Halaman pertama - surat_pengadaan
$html1 = '<h2 style="text-align: center;">DATA SURAT PENGADAAN</h2>';
$html1 .= '<p>Diproses: ' . $count_pengadaan['Diproses'] . ' | Disetujui: ' . $count_pengadaan['Disetujui'] . ' | Ditolak: ' . $count_pengadaan['Ditolak'] . '</p>';
$html1 .= '<table border="1" width="100%" cellpadding="5" cellspacing="0" style="border-collapse: collapse; text-align: center;">';
$html1 .= '<tr style="background-color: #f2f2f2;"><th>No. Surat</th><th>Tanggal</th><th>Nama Barang</th><th>Deskripsi</th><th>Tujuan</th><th>Jumlah</th><th>Anggaran</th><th>Link Surat</th><th>Status</th><th>ID Staf</th></tr>';
$result1 = $conn->query($query1); // Query ulang untuk reset pointer hasil
while ($row = $result1->fetch_assoc()) {
    $html1 .= '<tr><td>' . $row['no_surat'] . '</td><td>' . $row['tanggal'] . '</td><td>' . $row['nama_barang'] . '</td><td>' . $row['deskripsi'] . '</td><td>' . $row['tujuan'] . '</td><td>' . $row['jumlah'] . '</td><td>' . $row['anggaran'] . '</td><td><a href="' . $row['link_surat'] . '">Lihat</a></td><td>' . ucfirst($row['status']) . '</td><td>' . $row['ID_staf'] . '</td></tr>';
}
$html1 .= '</table>';

$mpdf->WriteHTML($html1);
$mpdf->AddPage();

// Halaman kedua - surat_pengambilan
$html2 = '<h2 style="text-align: center;">DATA SURAT PENGAMBILAN</h2>';
$html2 .= '<p>Diproses: ' . $count_pengambilan['Diproses'] . ' | Disetujui: ' . $count_pengambilan['Disetujui'] . ' | Ditolak: ' . $count_pengambilan['Ditolak'] . '</p>';
$html2 .= '<table border="1" width="100%" cellpadding="5" cellspacing="0" style="border-collapse: collapse; text-align: center;">';
$html2 .= '<tr style="background-color: #f2f2f2;"><th>No. Surat</th><th>Tanggal</th><th>Nama Barang</th><th>Jumlah</th><th>Tujuan</th><th>Link Surat</th><th>Status</th><th>ID Staf</th></tr>';
$result2 = $conn->query($query2); // Query ulang untuk reset pointer hasil
while ($row = $result2->fetch_assoc()) {
    $html2 .= '<tr><td>' . $row['no_surat'] . '</td><td>' . $row['tanggal'] . '</td><td>' . $row['nama_barang'] . '</td><td>' . $row['jumlah'] . '</td><td>' . $row['tujuan'] . '</td><td><a href="' . $row['link_surat'] . '">Lihat</a></td><td>' . ucfirst($row['status']) . '</td><td>' . $row['ID_staf'] . '</td></tr>';
}
$html2 .= '</table>';

$mpdf->WriteHTML($html2);

// Output PDF
$mpdf->Output('surat_pengadaan_pengambilan.pdf', 'D');
?>
