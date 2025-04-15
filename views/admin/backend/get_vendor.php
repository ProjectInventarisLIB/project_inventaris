<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

$draw   = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
$start  = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;
$search = isset($_POST['search']['value']) ? $conn->real_escape_string($_POST['search']['value']) : "";

// Ambil total data tanpa filter
$totalDataQuery = $conn->query("SELECT COUNT(*) AS total FROM vendor");
$totalData = $totalDataQuery->fetch_assoc()['total'];

// Query dengan filter pencarian
$sql = "SELECT * FROM vendor";
if (!empty($search)) {
    $sql .= " WHERE nama_vendor LIKE '%$search%' OR ID_vendor LIKE '%$search%'";
}

// Hitung total setelah pencarian
$filteredDataQuery = $conn->query("SELECT COUNT(*) AS total FROM vendor WHERE nama_vendor LIKE '%$search%' OR ID_vendor LIKE '%$search%'");
$recordsFiltered = $filteredDataQuery->fetch_assoc()['total'];

// Tambahkan pagination
$sql .= " LIMIT $start, $length";
$query = $conn->query($sql);

$data = [];
while ($row = $query->fetch_assoc()) {
    $data[] = [
        "ID_vendor" => $row['ID_vendor'],
        "nama_vendor" => $row['nama_vendor'],
        "alamat_vendor" => $row['alamat_vendor'],
        "no_telepon" => $row['no_telepon']
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
