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
        if (hash('sha256', $password) === $row['sandi_admin_utama']) {// Menggunakan sha256()
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
        if (hash('sha256', $password) === $row['sandi_admin']) { // Menggunakan sha256()
            $_SESSION['role'] = 'admin';
            $_SESSION['ID_admin'] = $row['ID_admin'];
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
        if (hash('sha256', $password) === $row['sandi_staf']) {    // Menggunakan sha256()
            $_SESSION['role'] = 'staf';
            $_SESSION['ID_staf'] = $row['ID_staf'];
            header("Location: views/staf/index");
            exit();
        }
    }

    // Jika tidak cocok
    $_SESSION['error'] = "Email atau kata sandi salah";
    header("Location: login.php");
    exit();
} else {
    echo 'tidak terjalankan';
}
?>
