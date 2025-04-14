<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");

$tahun_ini = date("Y");

$query = "SELECT COUNT(*) as jumlah FROM surat_pengambilan WHERE ID_pengambilan LIKE 'PG-$tahun_ini%'"; 
$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);
$jumlah = $data['jumlah'] + 1;
$nomor_urut = str_pad($jumlah, 3, "0", STR_PAD_LEFT);

$id_pengambilan = "PG-" . $tahun_ini . "-" . $nomor_urut;

header('Content-Type: application/json');
echo json_encode(["id_pengambilan" => $id_pengambilan]);
?>
