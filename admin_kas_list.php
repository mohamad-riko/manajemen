<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

include 'koneksi.php'; // Koneksi ke database

$query = "SELECT * FROM kas_keuangan ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kas Keuangan</title>
</head>
<body>
    <h2>Daftar Kas Keuangan</h2>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Uraian</th>
                <th>Qty</th>
                <th>Satuan</th>
                <th>Deskripsi</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['tanggal']}</td>
                        <td>{$row['uraian']}</td>
                        <td>{$row['qty']}</td>
                        <td>{$row['satuan']}</td>
                        <td>{$row['deskripsi']}</td>
                        <td>Rp " . number_format($row['masuk'], 2, ',', '.') . "</td>
                        <td>Rp " . number_format($row['keluar'], 2, ',', '.') . "</td>
                        <td>Rp " . number_format($row['saldo'], 2, ',', '.') . "</td>
                    </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>
