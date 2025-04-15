<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

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

// Ambil total data tanpa filter tetapi hanya yang berstatus "Diproses"
$totalDataQuery = $conn->query("SELECT COUNT(*) AS total FROM surat_pengambilan WHERE status = 'Diproses'");
$totalData = $totalDataQuery->fetch_assoc()['total'];

// Query dengan filter pencarian dan JOIN ke tabel staf, serta hanya status "Diproses"
// DIUBAH: Menambahkan JOIN ke tabel detail_pengambilan untuk mendapatkan nama_barang dan ID_barang
$sql = "SELECT s.no_surat, s.tanggal, s.link_surat, s.status, st.nama_staf,
               GROUP_CONCAT(d.nama_barang ORDER BY d.nama_barang ASC SEPARATOR ', ') AS nama_barang,
               GROUP_CONCAT(d.ID_barang ORDER BY d.nama_barang ASC SEPARATOR ', ') AS ID_barang
        FROM surat_pengambilan s 
        LEFT JOIN staf st ON s.ID_staf = st.ID_staf
        LEFT JOIN detail_pengambilan d ON s.ID_pengambilan = d.ID_pengambilan
        WHERE s.status = 'Diproses'";

if (!empty($search)) {
    $sql .= " AND (d.nama_barang LIKE '%$search%' OR s.no_surat LIKE '%$search%' OR st.nama_staf LIKE '%$search%')";
}

// Hitung total setelah pencarian
// DIUBAH: Menyesuaikan query filter dengan menggunakan JOIN
$filteredDataQuery = $conn->query("SELECT COUNT(DISTINCT s.ID_pengambilan) AS total 
                                   FROM surat_pengambilan s 
                                   LEFT JOIN staf st ON s.ID_staf = st.ID_staf
                                   LEFT JOIN detail_pengambilan d ON s.ID_pengambilan = d.ID_pengambilan
                                   WHERE s.status = 'Diproses' 
                                   AND (d.nama_barang LIKE '%$search%' OR s.no_surat LIKE '%$search%' OR st.nama_staf LIKE '%$search%')");
$recordsFiltered = $filteredDataQuery->fetch_assoc()['total'];

// Tambahkan sorting
$sql .= " GROUP BY s.ID_pengambilan ORDER BY $orderColumn $orderDir";

// Tambahkan pagination
$sql .= " LIMIT $start, $length";
$query = $conn->query($sql);

$data = [];
while ($row = $query->fetch_assoc()) {
    // DIUBAH: Menggabungkan nama_barang dan ID_barang
    $IDs = explode(",", $row['ID_barang']);
    $names = explode(",", $row['nama_barang']);
    $combined = [];

    for ($i = 0; $i < count($names); $i++) {
        $combined[] = trim($names[$i]) . " (" . trim($IDs[$i]) . ")";
    }

    // Gabungkan hasilnya menjadi string
    $nama_barang_final = implode(", ", $combined);

    $data[] = [
        $row['no_surat'],        
        $row['tanggal'],         
        $row['nama_staf'],
        $nama_barang_final, // Tampilkan format yang benar
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
