<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

include 'koneksi.php'; // Koneksi ke database

// Ambil data kas_keuangan
$query = "SELECT * FROM kas_keuangan ORDER BY id ASC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitur Keuangan</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styling untuk modal */
        .modal-content {
            padding: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1>Fitur Keuangan</h1>
    <!-- Tombol untuk membuka modal tambah data -->
    <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#addModal">Tambah Data Keuangan</button>

    <!-- Tabel untuk menampilkan data keuangan -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Uraian</th>
                <th>Qty</th>
                <th>Satuan</th>
                <th>Deskripsi</th>
                <th>Uang Masuk</th>
                <th>Uang Keluar</th>
                <th>Saldo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $prevSaldo = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $saldo = $prevSaldo + ($row['uang_masuk'] - $row['uang_keluar']);
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['tanggal']}</td>
                        <td>{$row['uraian']}</td>
                        <td>{$row['qty']}</td>
                        <td>{$row['satuan']}</td>
                        <td>{$row['deskripsi']}</td>
                        <td>Rp " . number_format($row['uang_masuk'], 2, ',', '.') . "</td>
                        <td>Rp " . number_format($row['uang_keluar'], 2, ',', '.') . "</td>
                        <td>Rp " . number_format($saldo, 2, ',', '.') . "</td>
                        <td>
                            <button class='btn btn-warning btn-sm' onclick='openEditModal({$row['id']}, \"{$row['tanggal']}\", \"{$row['uraian']}\", {$row['qty']}, \"{$row['satuan']}\", \"{$row['deskripsi']}\", {$row['uang_masuk']}, {$row['uang_keluar']})'>Edit</button>
                        </td>
                      </tr>";
                $prevSaldo = $saldo;
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal untuk tambah data keuangan -->
<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Form Tambah Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="kas_proses.php">
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="uraian">Uraian:</label>
                        <input type="text" class="form-control" name="uraian" required>
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty:</label>
                        <input type="number" class="form-control" name="qty" required>
                    </div>
                    <div class="form-group">
                        <label for="satuan">Satuan:</label>
                        <input type="text" class="form-control" name="satuan" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi:</label>
                        <input type="text" class="form-control" name="deskripsi" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_transaksi">Jenis Transaksi:</label>
                        <select name="jenis_transaksi" class="form-control" required>
                            <option value="masuk">Uang Masuk</option>
                            <option value="keluar">Uang Keluar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga_satuan">Harga per Unit:</label>
                        <input type="number" class="form-control" name="harga_satuan" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Edit Data Keuangan -->
<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Form Edit Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="edit_kas_proses.php">
                    <input type="hidden" name="id" id="editId">
                    <div class="form-group">
                        <label for="editTanggal">Tanggal:</label>
                        <input type="date" class="form-control" name="tanggal" id="editTanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="editUraian">Uraian:</label>
                        <input type="text" class="form-control" name="uraian" id="editUraian" required>
                    </div>
                    <div class="form-group">
                        <label for="editQty">Qty:</label>
                        <input type="number" class="form-control" name="qty" id="editQty" required>
                    </div>
                    <div class="form-group">
                        <label for="editSatuan">Satuan:</label>
                        <input type="text" class="form-control" name="satuan" id="editSatuan" required>
                    </div>
                    <div class="form-group">
                        <label for="editDeskripsi">Deskripsi:</label>
                        <input type="text" class="form-control" name="deskripsi" id="editDeskripsi" required>
                    </div>
                    <div class="form-group">
                        <label for="editJenisTransaksi">Jenis Transaksi:</label>
                        <select name="jenis_transaksi" class="form-control" id="editJenisTransaksi" required>
                            <option value="masuk">Uang Masuk</option>
                            <option value="keluar">Uang Keluar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editHargaSatuan">Harga per Unit:</label>
                        <input type="number" class="form-control" name="harga_satuan" id="editHargaSatuan" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript dan Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Fungsi untuk membuka modal edit dan mengisi form dengan data yang akan diedit
function openEditModal(id, tanggal, uraian, qty, satuan, deskripsi, uangMasuk, uangKeluar) {
    document.getElementById("editId").value = id;
    document.getElementById("editTanggal").value = tanggal;
    document.getElementById("editUraian").value = uraian;
    document.getElementById("editQty").value = qty;
    document.getElementById("editSatuan").value = satuan;
    document.getElementById("editDeskripsi").value = deskripsi;
    document.getElementById("editJenisTransaksi").value = uangMasuk > 0 ? "masuk" : "keluar";
    document.getElementById("editHargaSatuan").value = uangMasuk > 0 ? (uangMasuk / qty) : (uangKeluar / qty);

    $('#editModal').modal('show');
}
</script>

</body>
</html>
