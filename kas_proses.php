<?php
session_start();
include 'koneksi.php'; // Koneksi ke database

if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Ambil data dari form
$tanggal = $_POST['tanggal'];
$uraian = $_POST['uraian'];
$qty = $_POST['qty'];
$satuan = $_POST['satuan'];
$deskripsi = $_POST['deskripsi'];
$jenis_transaksi = $_POST['jenis_transaksi'];
$harga_satuan = $_POST['harga_satuan'];

// Hitung uang masuk atau keluar berdasarkan jenis transaksi
if ($jenis_transaksi == 'masuk') {
    $uang_masuk = $qty * $harga_satuan;
    $uang_keluar = 0;
} else {
    $uang_keluar = $qty * $harga_satuan;
    $uang_masuk = 0;
}

// Mengambil saldo terakhir dari transaksi sebelumnya
$querySaldo = "SELECT saldo FROM kas_keuangan ORDER BY id DESC LIMIT 1";
$resultSaldo = mysqli_query($conn, $querySaldo);
$lastSaldo = mysqli_fetch_assoc($resultSaldo);

// Jika tidak ada transaksi sebelumnya, saldo dimulai dari 0
$saldo = isset($lastSaldo['saldo']) ? $lastSaldo['saldo'] + $uang_masuk - $uang_keluar : $uang_masuk - $uang_keluar;

// Simpan transaksi ke database
$query = "INSERT INTO kas_keuangan (tanggal, uraian, qty, satuan, deskripsi, jenis_transaksi, uang_masuk, uang_keluar, saldo)
          VALUES ('$tanggal', '$uraian', '$qty', '$satuan', '$deskripsi', '$jenis_transaksi', '$uang_masuk', '$uang_keluar', '$saldo')";

if (mysqli_query($conn, $query)) {
    header('Location: keuangan.php'); // Kembali ke halaman keuangan
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
