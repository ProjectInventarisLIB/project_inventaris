<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

$draw   = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
$start  = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;
$search = isset($_POST['search']['value']) ? $conn->real_escape_string($_POST['search']['value']) : "";

// Ambil total data tanpa filter
$totalDataQuery = $conn->query("SELECT COUNT(*) AS total FROM staf");
$totalData = $totalDataQuery->fetch_assoc()['total'];

// Query dengan filter pencarian
$sql = "SELECT * FROM staf";
if (!empty($search)) {
    $sql .= " WHERE nama_staf LIKE '%$search%' OR ID_staf LIKE '%$search%'";
}

// Hitung total setelah pencarian
$filteredDataQuery = $conn->query("SELECT COUNT(*) AS total FROM staf WHERE nama_staf LIKE '%$search%' OR ID_staf LIKE '%$search%'");
$recordsFiltered = $filteredDataQuery->fetch_assoc()['total'];

// Tambahkan pagination
$sql .= " LIMIT $start, $length";
$query = $conn->query($sql);

$data = [];
while ($row = $query->fetch_assoc()) {
    $data[] = [
        "ID_staf" => $row['ID_staf'],
        "nama_staf" => $row['nama_staf'],
        "email_staf" => $row['email_staf'],
        "anggaran" => $row['anggaran'],
        "pengeluaran_anggaran" => $row['pengeluaran_anggaran'],
        "periode_anggaran" => $row['periode_anggaran']
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
