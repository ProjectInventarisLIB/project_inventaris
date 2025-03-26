<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_web/config/konfigurasi.php");

$draw   = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
$start  = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;
$search = isset($_POST['search']['value']) ? $conn->real_escape_string($_POST['search']['value']) : "";

// Ambil parameter sorting
$columns = ["no_surat", "tanggal", "nama_barang"];
$orderColumnIndex = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
$orderDir = isset($_POST['order'][0]['dir']) && $_POST['order'][0]['dir'] === 'desc' ? 'DESC' : 'ASC';

// Pastikan kolom yang dipilih ada dalam daftar
$orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : "no_surat";

// Ambil total data tanpa filter
$totalDataQuery = $conn->query("SELECT COUNT(*) AS total FROM surat_pengadaan");
$totalData = $totalDataQuery->fetch_assoc()['total'];

// Query dengan filter pencarian dan JOIN ke tabel staf
$sql = "SELECT s.no_surat, s.tanggal, s.nama_barang, s.anggaran, s.link_surat, s.status, 
               st.nama_staf 
        FROM surat_pengadaan s 
        LEFT JOIN staf st ON s.ID_staf = st.ID_staf";

if (!empty($search)) {
    $sql .= " WHERE (s.nama_barang LIKE '%$search%' OR s.no_surat LIKE '%$search%' OR st.nama_staf LIKE '%$search%')";
}

// Hitung total setelah pencarian
$filteredDataQuery = $conn->query("SELECT COUNT(*) AS total 
                                   FROM surat_pengadaan s 
                                   LEFT JOIN staf st ON s.ID_staf = st.ID_staf 
                                   WHERE s.nama_barang LIKE '%$search%' OR s.no_surat LIKE '%$search%' OR st.nama_staf LIKE '%$search%'");
$recordsFiltered = $filteredDataQuery->fetch_assoc()['total'];

// Tambahkan sorting
$sql .= " ORDER BY $orderColumn $orderDir";

// Tambahkan pagination
$sql .= " LIMIT $start, $length";
$query = $conn->query($sql);

$data = [];
while ($row = $query->fetch_assoc()) {
    $data[] = [
        $row['no_surat'],        
        $row['tanggal'],         
        $row['nama_staf'],
        $row['nama_barang'],     
        $row['anggaran'],        
        "<a href='" . $row['link_surat'] . "' target='_blank'>Lihat Surat</a>", 
        $row['status']
            
    ];
}

// Format JSON
$response = [
    "draw" => $draw,
    "recordsTotal" => $totalData,
    "recordsFiltered" => $recordsFiltered,
    "data" => $data
];

header('Content-Type: application/json');
echo json_encode($response);
?>
