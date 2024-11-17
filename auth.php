<?php
session_start();
include 'koneksi.php'; // Koneksi ke database

// Ambil input dari form login
$username = $_POST['username'];
$password = md5($_POST['password']); // Enkripsi password dengan MD5

// Query ke database
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($user) {
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    
    if ($user['role'] == 'admin') {
        header('Location: admin_dashboard.php'); // Halaman admin
    } elseif ($user['role'] == 'anggota') {
        header('Location: anggota_dashboard.php'); // Halaman anggota
    }
} else {
    echo "Username atau password salah!";
}
?>
