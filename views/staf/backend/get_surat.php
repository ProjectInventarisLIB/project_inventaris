<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_web/config/konfigurasi.php");

header('Content-Type: application/json');

$queries = [
    "total_pengadaan" => "SELECT COUNT(*) AS total FROM surat_pengadaan",
    "total_peminjaman" => "SELECT COUNT(*) AS total FROM surat_pengambilan",
    "pengadaan_disetujui" => "SELECT COUNT(*) AS total FROM surat_pengadaan WHERE status = 'Disetujui'",
    "peminjaman_disetujui" => "SELECT COUNT(*) AS total FROM surat_pengambilan WHERE status = 'Disetujui'"
];

$data = [];

foreach ($queries as $key => $sql) {
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $data[$key] = $row['total'];
    } else {
        $data[$key] = "Query error: " . mysqli_error($conn);
    }
}

echo json_encode($data);

mysqli_close($conn);
?>
