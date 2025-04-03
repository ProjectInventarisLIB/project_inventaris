<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

// // Ambil bulan dan tahun sekarang
$currentMonth = (int)date('n'); // Bulan sekarang (1-12)
$currentYear = (int)date('Y'); // Tahun sekarang

//SIMULASI TANGGAL FAKE
// $fakeDate = "2025-08-12";
// $currentMonth = (int)date('n', strtotime($fakeDate));
// $currentYear = (int)date('Y', strtotime($fakeDate)); 

// Tentukan range 6 bulan (Januari - Juni atau Juli - Desember)
if ($currentMonth <= 6) {
    $startMonth = 1;  // Januari
    $endMonth = 6;    // Juni
} else {
    $startMonth = 7;  // Juli
    $endMonth = 12;   // Desember
}

// Query untuk mendapatkan jumlah barang masuk dan barang keluar per bulan
$query = "
    -- Barang Masuk dari tabel barang (menghitung jumlah baris)
    SELECT MONTH(tanggal) AS bulan, COUNT(*) AS total, 'Barang Masuk' AS kategori 
    FROM barang 
    WHERE YEAR(tanggal) = $currentYear AND MONTH(tanggal) BETWEEN $startMonth AND $endMonth
    GROUP BY bulan
    UNION ALL
    -- Barang Keluar dari tabel barang_pengambilan (menghitung jumlah baris)
    SELECT MONTH(tanggal) AS bulan, COUNT(*) AS total, 'Barang Keluar' AS kategori
    FROM barang_pengambilan
    WHERE YEAR(tanggal) = $currentYear AND MONTH(tanggal) BETWEEN $startMonth AND $endMonth
    GROUP BY bulan
";

$result = $conn->query($query);

// Inisialisasi struktur data untuk JSON ApexCharts
$data = [
    "labels" => [], // Akan diisi dengan nama bulan
    "series" => [
        ["name" => "Barang Masuk", "data" => array_fill(0, 6, 0)],
        ["name" => "Barang Keluar", "data" => array_fill(0, 6, 0)]
    ]
];

// Tentukan label bulan (Jan-Jun atau Jul-Des)
$namaBulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
$data["labels"] = array_slice($namaBulan, $startMonth - 1, 6);

// Memasukkan data ke dalam array berdasarkan bulan
while ($row = $result->fetch_assoc()) {
    $bulanIndex = (int)$row["bulan"] - $startMonth; // Menyesuaikan index array (0-5)

    if ($row["kategori"] == "Barang Masuk") {
        $data["series"][0]["data"][$bulanIndex] += (int)$row["total"];
    } elseif ($row["kategori"] == "Barang Keluar") {
        $data["series"][1]["data"][$bulanIndex] += (int)$row["total"];
    }
}

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
