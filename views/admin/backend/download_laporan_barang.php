<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/vendor/autoload.php");

// Query barang_pendataan
$query1 = "SELECT * FROM barang";
$result1 = $conn->query($query1);
$total_dana_pendataan = 0;

// Query barang_pengadaan
$query2 = "SELECT * FROM barang_pengadaan";
$result2 = $conn->query($query2);
$total_dana_pengadaan = 0;

// Query barang_pengambilan
$query3 = "SELECT * FROM barang_pengambilan";
$result3 = $conn->query($query3);

$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']); // Set landscape

// Gaya CSS
$style = '
    <style>
        table { border-collapse: collapse; width: 100%; text-align: center; }
        th { background-color: #0067A2; color: white; padding: 8px; }
        td { padding: 8px; border: 1px solid #000; }
        .total-row { background-color: #D3D3D3; font-weight: bold; color: black; }
        .small-col { width: 10%; }
    </style>
';

// Halaman 1 - Barang Pendataan
$html1 = $style . '<h2 style="text-align: center;">DATA BARANG PENDATAAN</h2>';
$html1 .= '<p style="text-align: right;">Tanggal: ' . date('d-m-Y') . '</p>';
$html1 .= '<table border="1">';
$html1 .= '<tr><th>ID Barang</th><th>Nama Barang</th><th>Jumlah</th><th>Satuan</th><th>Ukuran</th><th>Tanggal</th><th>Vendor</th><th>Dana Final</th></tr>';
while ($row = $result1->fetch_assoc()) {
    $total_dana_pendataan += $row['dana_final'];
    $html1 .= '<tr>
        <td>' . $row['ID_barang'] . '</td>
        <td>' . $row['nama_barang'] . '</td>
        <td class="small-col">' . $row['jumlah_barang'] . '</td>
        <td>' . $row['satuan'] . '</td>
        <td>' . $row['ukuran'] . '</td>
        <td>' . $row['tanggal'] . '</td>
        <td>' . $row['nama_vendor'] . '</td>
        <td>' . number_format($row['dana_final'], 2, ',', '.') . '</td>
    </tr>';
}
$html1 .= '<tr class="total-row"><td colspan="7"><strong>TOTAL DANA</strong></td><td><strong>' . number_format($total_dana_pendataan, 2, ',', '.') . '</strong></td></tr>';
$html1 .= '</table>';
$mpdf->WriteHTML($html1);
$mpdf->AddPage('L');

// Halaman 2 - Barang Pengadaan
$html2 = $style . '<h2 style="text-align: center;">DATA BARANG PENGADAAN</h2>';
$html2 .= '<p style="text-align: right;">Tanggal: ' . date('d-m-Y') . '</p>';
$html2 .= '<table border="1">';
$html2 .= '<tr><th>ID Barang</th><th>No. Surat</th><th>Tanggal</th><th>Nama Barang</th><th>Deskripsi</th><th>Jumlah Diperlukan</th><th>Satuan</th><th>Vendor</th><th>Dana Final</th></tr>';
while ($row = $result2->fetch_assoc()) {
    $total_dana_pengadaan += $row['dana_final'];
    $html2 .= '<tr>
        <td>' . $row['ID_barang'] . '</td>
        <td>' . $row['no_surat'] . '</td>
        <td>' . $row['tanggal'] . '</td>
        <td>' . $row['nama_barang'] . '</td>
        <td>' . $row['deskripsi'] . '</td>
        <td class="small-col">' . $row['jumlah_diperlukan'] . '</td>
        <td>' . $row['satuan'] . '</td>
        <td>' . $row['nama_vendor'] . '</td>
        <td>' . number_format($row['dana_final'], 2, ',', '.') . '</td>
    </tr>';
}
$html2 .= '<tr class="total-row"><td colspan="8"><strong>TOTAL DANA</strong></td><td><strong>' . number_format($total_dana_pengadaan, 2, ',', '.') . '</strong></td></tr>';
$html2 .= '</table>';
$mpdf->WriteHTML($html2);
$mpdf->AddPage('L');

// Halaman 3 - Barang Pengambilan
$html3 = $style . '<h2 style="text-align: center;">DATA BARANG PENGAMBILAN</h2>';
$html3 .= '<p style="text-align: right;">Tanggal: ' . date('d-m-Y') . '</p>';
$html3 .= '<table border="1">';
$html3 .= '<tr><th>ID Barang</th><th>Nama Barang</th><th>Tanggal</th><th class="small-col">Jumlah Diambil</th><th>No. Surat</th></tr>';
while ($row = $result3->fetch_assoc()) {
    $html3 .= '<tr>
        <td>' . $row['ID_barang'] . '</td>
        <td>' . $row['nama_barang'] . '</td>
        <td>' . $row['tanggal'] . '</td>
        <td class="small-col">' . $row['jumlah_diambil'] . '</td>
        <td>' . $row['no_surat'] . '</td>
    </tr>';
}
$html3 .= '</table>';
$mpdf->WriteHTML($html3);

// Output PDF
$mpdf->Output('laporan_barang.pdf', 'D');
?>
