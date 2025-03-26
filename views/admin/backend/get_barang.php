<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

$draw   = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
$start  = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;
$search = isset($_POST['search']['value']) ? $conn->real_escape_string($_POST['search']['value']) : "";

// Ambil parameter sorting
$columns = ["jumlah_barang", "ID_barang", "nama_barang"]; // Sesuaikan dengan urutan kolom
$orderColumnIndex = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
$orderDir = isset($_POST['order'][0]['dir']) && $_POST['order'][0]['dir'] === 'desc' ? 'DESC' : 'ASC';

// Pastikan kolom yang dipilih ada dalam daftar
$orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : "ID_barang";

// Ambil total data tanpa filter
$totalDataQuery = $conn->query("SELECT COUNT(*) AS total FROM barang");
$totalData = $totalDataQuery->fetch_assoc()['total'];

// Query dengan filter pencarian
$sql = "SELECT * FROM barang";
if (!empty($search)) {
    $sql .= " WHERE nama_barang LIKE '%$search%' OR ID_barang LIKE '%$search%'";
}

// Hitung total setelah pencarian
$filteredDataQuery = $conn->query("SELECT COUNT(*) AS total FROM barang WHERE nama_barang LIKE '%$search%' OR ID_barang LIKE '%$search%'");
$recordsFiltered = $filteredDataQuery->fetch_assoc()['total'];

// Tambahkan sorting
$sql .= " ORDER BY $orderColumn $orderDir";

// Tambahkan pagination
$sql .= " LIMIT $start, $length";
$query = $conn->query($sql);

$data = [];
while ($row = $query->fetch_assoc()) {
    $data[] = [
        "gambar" => $row['gambar'],
        "ID_barang" => $row['ID_barang'],
        "nama_barang" => $row['nama_barang'],
        "ukuran" => $row['ukuran'],
        "jumlah_barang" => $row['jumlah_barang']
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
