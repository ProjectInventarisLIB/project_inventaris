<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");
session_start(); // Pastikan session dimulai

// Pastikan pengguna sudah login dan ID_staff tersedia di session
if (!isset($_SESSION['ID_staf'])) {
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$ID_staff = $_SESSION['ID_staf']; // Ambil ID staff dari session

$draw   = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
$start  = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;
$search = isset($_POST['search']['value']) ? $conn->real_escape_string($_POST['search']['value']) : "";

// Ambil parameter sorting
$columns = ["no_surat", "tanggal", "nama_barang", "status", "ID_staf"];
$orderColumnIndex = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
$orderDir = isset($_POST['order'][0]['dir']) && $_POST['order'][0]['dir'] === 'desc' ? 'DESC' : 'ASC';

// Pastikan kolom yang dipilih ada dalam daftar
$orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : "no_surat";

// Ambil total data tanpa filter berdasarkan ID_staff
$totalDataQuery = $conn->query("SELECT COUNT(*) AS total FROM surat_pengambilan WHERE ID_staf = '$ID_staff'");
$totalData = $totalDataQuery->fetch_assoc()['total'];

// Query dengan filter pencarian
$sql = "
    SELECT sp.no_surat, sp.tanggal, sp.link_surat, sp.status,
           GROUP_CONCAT(dp.ID_barang ORDER BY dp.nama_barang ASC) AS ID_barang,
           GROUP_CONCAT(dp.nama_barang ORDER BY dp.nama_barang ASC) AS nama_barang
    FROM surat_pengambilan sp
    JOIN detail_pengambilan dp ON sp.ID_pengambilan = dp.ID_pengambilan
    WHERE sp.ID_staf = '$ID_staff'";

if (!empty($search)) {
    $sql .= " AND (dp.nama_barang LIKE '%$search%' OR sp.no_surat LIKE '%$search%')";
}

// Hitung total setelah pencarian
$filteredDataQuery = $conn->query("SELECT COUNT(DISTINCT sp.ID_pengambilan) AS total 
    FROM surat_pengambilan sp
    JOIN detail_pengambilan dp ON sp.ID_pengambilan = dp.ID_pengambilan
    WHERE sp.ID_staf = '$ID_staff' AND (dp.nama_barang LIKE '%$search%' OR sp.no_surat LIKE '%$search%')");
$recordsFiltered = $filteredDataQuery->fetch_assoc()['total'];

// Tambahkan sorting
$sql .= " GROUP BY sp.ID_pengambilan ORDER BY $orderColumn $orderDir";

// Tambahkan pagination
$sql .= " LIMIT $start, $length";
$query = $conn->query($sql);

$data = [];
while ($row = $query->fetch_assoc()) {
    // Pisahkan ID_barang dan nama_barang menjadi array
    $ID_barang = explode(",", $row['ID_barang']);
    $nama_barang = explode(",", $row['nama_barang']);
    
    // Gabungkan ID_barang dan nama_barang sesuai format yang diinginkan
    $barang_tergabung = [];
    for ($i = 0; $i < count($ID_barang); $i++) {
        $barang_tergabung[] = $nama_barang[$i] . " (" . $ID_barang[$i] . ")";
    }
    
    // Gabungkan hasilnya menjadi string
    $nama_barang_final = implode(", ", $barang_tergabung);

    $data[] = [
        "no_surat" => $row['no_surat'],
        "tanggal" => $row['tanggal'],
        "nama_barang" => $nama_barang_final, // Tampilkan format yang benar
        "link_surat" => "<a href='" . $row['link_surat'] . "' target='_blank'>Lihat Surat</a>",
        "status" => $row['status']
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
