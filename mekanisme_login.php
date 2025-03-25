<?php
session_start();
include 'config/konfigurasi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek di tabel admin_utama
    $query = "SELECT * FROM admin_utama WHERE email_admin_utama = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // if (password_verify($password, $row['sandi_admin_utama'])) {
        if ($password === $row['sandi_admin_utama']) {
            $_SESSION['role'] = 'admin_utama';
            $_SESSION['user_id'] = $row['id'];
            header("Location: views/super_admin/index");
            exit();
        }
    }
    
    // Cek di tabel admin
    $query = "SELECT * FROM admin WHERE email_admin = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // if (password_verify($password, $row['sandi_admin'])) {
        if ($password === $row['sandi_admin']) {
            $_SESSION['role'] = 'admin';
            $_SESSION['user_id'] = $row['id'];
            header("Location: views/admin/index");
            exit();
        }
    }

    // Cek di tabel staf
    $query = "SELECT * FROM staf WHERE email_staf = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // if (password_verify($password, $row['sandi_staf'])) {
        if ($password === $row['sandi_staf']) {
            $_SESSION['role'] = 'staf';
            $_SESSION['ID_staf'] = $row['ID_staf'];
            // var_dump($_SESSION); //untuk cek session
            // exit();
            header("Location: views/staf/index");
            exit();
        }
    }

    // Jika tidak cocok
    $_SESSION['error'] = "Email atau kata sandi salah";
    header("Location: login.php");
    exit();
}
else { echo 'tidak terjalankan'; }
?>
