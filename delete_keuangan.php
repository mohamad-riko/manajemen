<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

include 'koneksi.php'; // Koneksi ke database

// Ambil ID dari URL
$id = $_GET['id'];

// Hapus data berdasarkan ID
$query = "DELETE FROM kas_keuangan WHERE id = '$id'";

if (mysqli_query($conn, $query)) {
    header('Location: keuangan.php'); // Kembali ke halaman keuangan setelah delete
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
