<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/vendor/autoload.php");

if (!isset($_SESSION['ID_staf'])) {
    echo "Akses ditolak! Silakan login terlebih dahulu.";
    exit;
}

$id_staf = $_SESSION['ID_staf'];
$tanggal_hari_ini = date("d-m-Y");

// Ambil data dari surat_pengadaan, kecuali yang statusnya 'Selesai'
$query1 = "SELECT * FROM surat_pengadaan WHERE ID_staf = '$id_staf' AND status != 'Selesai'";
$result1 = $conn->query($query1);

// Ambil data dari surat_pengambilan disambungkan detail_pengambilan, kecuali yang statusnya 'Selesai'
$query2 = "SELECT sp.no_surat, sp.tanggal, sp.tujuan, sp.link_surat, sp.status, sp.ID_staf, sp.ID_pengambilan,
        dp.ID_barang, dp.nama_barang, dp.jumlah
        FROM surat_pengambilan sp
        JOIN detail_pengambilan dp ON sp.ID_pengambilan = dp.ID_pengambilan
        WHERE sp.ID_staf = '$id_staf' AND sp.status != 'Selesai'";
$result2 = $conn->query($query2);

// Hitung status pengadaan dan pengambilan
$count_pengadaan = ['Diproses' => 0, 'Disetujui' => 0, 'Ditolak' => 0];
while ($row = $result1->fetch_assoc()) {
    $status = ucfirst(strtolower($row['status']));
    if (isset($count_pengadaan[$status])) {
        $count_pengadaan[$status]++;
    }
}
$result1 = $conn->query($query1);

$count_pengambilan = ['Diproses' => 0, 'Disetujui' => 0, 'Ditolak' => 0];
while ($row = $result2->fetch_assoc()) {
    $status = ucfirst(strtolower($row['status']));
    if (isset($count_pengambilan[$status])) {
        $count_pengambilan[$status]++;
    }
}
$result2 = $conn->query($query2);

$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);

// ================== SURAT PENGADAAN ==================
$html1 = '<h2 style="text-align: center;">DATA SURAT PENGADAAN</h2>';
$html1 .= '<p>Tanggal cetak: ' . $tanggal_hari_ini . '</p>';
$html1 .= '<p>Diproses: ' . $count_pengadaan['Diproses'] . ' | Disetujui: ' . $count_pengadaan['Disetujui'] . ' | Ditolak: ' . $count_pengadaan['Ditolak'] . '</p>';

$html1 .= '<table border="1" width="100%" cellpadding="5" cellspacing="0" style="border-collapse: collapse; text-align: center;">';
$html1 .= '<tr style="background-color: #f2f2f2;">
    <th>No. Surat</th>
    <th>Tanggal</th>
    <th>Nama Barang</th>
    <th>Deskripsi</th>
    <th>Tujuan</th>
    <th>Jumlah</th>
    <th>Satuan</th>
    <th>Anggaran</th>
    <th>Link Surat</th>
    <th>Status</th>
    <th>ID Staf</th>
</tr>';

while ($row = $result1->fetch_assoc()) {
    $html1 .= '<tr>
        <td>' . $row['no_surat'] . '</td>
        <td>' . $row['tanggal'] . '</td>
        <td>' . $row['nama_barang'] . '</td>
        <td>' . $row['deskripsi'] . '</td>
        <td>' . $row['tujuan'] . '</td>
        <td>' . $row['jumlah'] . '</td>
        <td>' . $row['satuan'] . '</td>
        <td style="text-align: right;">' . number_format($row['anggaran'], 2, ',', '.') . '</td>
        <td><a href="' . $row['link_surat'] . '">Lihat</a></td>
        <td>' . ucfirst($row['status']) . '</td>
        <td>' . $row['ID_staf'] . '</td>
    </tr>';
}
$html1 .= '</table>';
$mpdf->WriteHTML($html1);
$mpdf->AddPage();

// ================== SURAT PENGAMBILAN ==================
$html2 = '<h2 style="text-align: center;">DATA SURAT PENGAMBILAN</h2>';
$html2 .= '<p>Tanggal cetak: ' . $tanggal_hari_ini . '</p>';
$html2 .= '<p>Diproses: ' . $count_pengambilan['Diproses'] . ' | Disetujui: ' . $count_pengambilan['Disetujui'] . ' | Ditolak: ' . $count_pengambilan['Ditolak'] . '</p>';

$html2 .= '<table border="1" width="100%" cellpadding="5" cellspacing="0" style="border-collapse: collapse; text-align: center;">';
$html2 .= '<tr style="background-color: #f2f2f2;">
    <th>No. Surat</th>
    <th>Tanggal</th>
    <th>Barang & Jumlah</th>
    <th>Tujuan</th>
    <th>Link Surat</th>
    <th>Status</th>
    <th>ID Staf</th>
</tr>';

$pengambilan_data = [];

while ($row = $result2->fetch_assoc()) {
    $id_pengambilan = $row['ID_pengambilan'];

    if (!isset($pengambilan_data[$id_pengambilan])) {
        $pengambilan_data[$id_pengambilan] = [
            'no_surat' => $row['no_surat'],
            'tanggal' => $row['tanggal'],
            'tujuan' => $row['tujuan'],
            'link_surat' => $row['link_surat'],
            'status' => $row['status'],
            'ID_staf' => $row['ID_staf'],
            'barang' => []
        ];
    }

    $pengambilan_data[$id_pengambilan]['barang'][] = $row['jumlah'] . ' ' . $row['nama_barang'] . ' (' . $row['ID_barang'] . ')';
}

foreach ($pengambilan_data as $data) {
    $html2 .= '<tr>
        <td>' . $data['no_surat'] . '</td>
        <td>' . $data['tanggal'] . '</td>
        <td>' . implode(', ', $data['barang']) . '</td>
        <td>' . $data['tujuan'] . '</td>
        <td><a href="' . $data['link_surat'] . '">Lihat</a></td>
        <td>' . ucfirst($data['status']) . '</td>
        <td>' . $data['ID_staf'] . '</td>
    </tr>';
}


$html2 .= '</table>';
$mpdf->WriteHTML($html2);

$mpdf->Output('surat_pengadaan_pengambilan.pdf', 'D');
?>
