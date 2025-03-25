<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "inventaris_lib";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$base_url = "http://localhost/project_web";

?>
