<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Kas Keuangan</title>
</head>
<body>
    <h2>Form Kas Keuangan</h2>
    <form method="POST" action="kas_proses.php">
        <label>Tanggal:</label><br>
        <input type="date" name="tanggal" required><br><br>

        <label>Uraian:</label><br>
        <input type="text" name="uraian" required><br><br>

        <label>Qty:</label><br>
        <input type="number" name="qty"><br><br>

        <label>Satuan:</label><br>
        <input type="text" name="satuan"><br><br>

        <label>Deskripsi:</label><br>
        <input type="text" name="deskripsi" required><br><br>

        <label>Masuk:</label><br>
        <input type="number" name="masuk" step="0.01" value="0.00"><br><br>

        <label>Keluar:</label><br>
        <input type="number" name="keluar" step="0.01" value="0.00"><br><br>

        <input type="submit" value="Simpan">
    </form>
</body>
</html>
