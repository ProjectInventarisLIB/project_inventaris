<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");
session_start();

$idStaf = $_SESSION['ID_staf']; // ID staf yang sedang login
$tanggalDiperlukan = date("Y-m-d"); // Default tanggal hari ini

// Ambil bulan dan tahun dari tanggal yang diinput
$bulan = date("m", strtotime($tanggalDiperlukan));
$tahun = date("Y", strtotime($tanggalDiperlukan));

// Konversi bulan ke format Romawi
$bulanRomawi = [
    "01" => "I", "02" => "II", "03" => "III", "04" => "IV",
    "05" => "V", "06" => "VI", "07" => "VII", "08" => "VIII",
    "09" => "IX", "10" => "X", "11" => "XI", "12" => "XII"
];
$bulanRomawi = $bulanRomawi[$bulan];

// Ambil nomor terakhir dari database
$queryLastNo = "SELECT no_surat FROM surat_pengadaan ORDER BY ID_surat DESC LIMIT 1";
$resultLastNo = $conn->query($queryLastNo);

if ($resultLastNo->num_rows > 0) {
    $row = $resultLastNo->fetch_assoc();
    preg_match('/^(\d{3})\//', $row['no_surat'], $matches);
    $lastNo = isset($matches[1]) ? (int)$matches[1] + 1 : 1;
} else {
    $lastNo = 1;
}

// Format nomor surat
$noSurat = sprintf("%03d/LIB-Ajukan/%s/%s", $lastNo, $bulanRomawi, $tahun);

// Mengembalikan nomor surat dalam format JSON
echo json_encode(["no_surat" => $noSurat]);
?>
