<?php
include 'koneksi.php';

$id = $_POST['id'];
$tanggal = $_POST['tanggal'];
$uraian = $_POST['uraian'];
$qty = $_POST['qty'];
$satuan = $_POST['satuan'];
$deskripsi = $_POST['deskripsi'];
$jenis_transaksi = $_POST['jenis_transaksi'];
$harga_satuan = $_POST['harga_satuan'];

// Hitung uang masuk atau keluar
$uang_masuk = ($jenis_transaksi == 'masuk') ? $qty * $harga_satuan : 0;
$uang_keluar = ($jenis_transaksi == 'keluar') ? $qty * $harga_satuan : 0;
$saldo = $uang_masuk - $uang_keluar;

// Mulai transaksi update saldo
mysqli_begin_transaction($conn);

try {
    // Update data yang diedit
    $query = "UPDATE kas_keuangan SET
        tanggal = '$tanggal',
        uraian = '$uraian',
        qty = '$qty',
        satuan = '$satuan',
        deskripsi = '$deskripsi',
        jenis_transaksi = '$jenis_transaksi',
        uang_masuk = '$uang_masuk',
        uang_keluar = '$uang_keluar',
        saldo = '$saldo'
    WHERE id = '$id'";

    if (!mysqli_query($conn, $query)) {
        throw new Exception("Gagal update data keuangan.");
    }

    // Setelah update data 2, kita harus memperbarui saldo data 3, dan seterusnya
    $result = mysqli_query($conn, "SELECT id, saldo FROM kas_keuangan ORDER BY id ASC");
    $prevSaldo = 0; // saldo awal adalah 0 untuk data pertama

    while ($row = mysqli_fetch_assoc($result)) {
        // Update saldo sesuai transaksi sebelumnya
        if ($row['id'] == $id) {
            $prevSaldo = $saldo; // Saldo yang telah diupdate
        } else {
            $newSaldo = $prevSaldo + $row['saldo']; // Menambahkan saldo sebelumnya dengan saldo saat ini
            $updateSaldoQuery = "UPDATE kas_keuangan SET saldo = '$newSaldo' WHERE id = {$row['id']}";
            if (!mysqli_query($conn, $updateSaldoQuery)) {
                throw new Exception("Gagal update saldo data keuangan.");
            }
            $prevSaldo = $newSaldo; // Update saldo sebelumnya untuk data berikutnya
        }
    }

    // Commit transaksi
    mysqli_commit($conn);

    // Arahkan kembali ke halaman keuangan.php
    header('Location: keuangan.php');
} catch (Exception $e) {
    // Rollback transaksi jika ada error
    mysqli_roll_back($conn);
    echo "Error: " . $e->getMessage();
}
?>
