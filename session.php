<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['ID_staf'])) {
    echo json_encode(["ID_staf" => $_SESSION['ID_staf'], "nama_staf" => $_SESSION['nama_staf']]);
} else {
    echo json_encode(["error" => "Session not found"]);
}
?>