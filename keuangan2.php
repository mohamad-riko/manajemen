<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitur Keuangan</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 600px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Add spacing between modal content for readability */
        .modal-content form {
            padding: 20px;
        }

        /* Button styling */
        .btn-custom {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .btn-danger-custom {
            background-color: #FF5733;
        }

        /* Table responsive styling */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            table-layout: fixed;
        }

        /* Styling for form inputs */
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        /* Custom styles for smaller devices */
        @media (max-width: 767px) {
            .modal-content {
                width: 95%;
            }

            .btn-custom {
                font-size: 14px;
            }

            .table thead th, .table tbody td {
                font-size: 14px;
            }

            .container {
                padding-left: 15px;
                padding-right: 15px;
            }

            .table-responsive {
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-4">
    <h1 class="text-center">Fitur Keuangan</h1>

    <!-- Button to open Add Modal -->
    <button class="btn btn-success" onclick="openModal('add')">Tambah Data Keuangan</button>

    <!-- Modal for Add Keuangan -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('add')">&times;</span>
            <h2>Form Keuangan</h2>
            <form method="POST" action="kas_proses.php">
                <label>Tanggal:</label>
                <input type="date" name="tanggal" required><br>

                <label>Uraian:</label>
                <input type="text" name="uraian" required><br>

                <label>Qty:</label>
                <input type="number" name="qty" required><br>

                <label>Satuan:</label>
                <input type="text" name="satuan" required><br>

                <label>Deskripsi:</label>
                <input type="text" name="deskripsi" required><br>

                <label>Jenis Transaksi:</label>
                <select name="jenis_transaksi" required>
                    <option value="masuk">Uang Masuk</option>
                    <option value="keluar">Uang Keluar</option>
                </select><br>

                <label>Satuan (Harga per Unit):</label>
                <input type="number" name="harga_satuan" step="0.01" required><br>

                <button type="submit" class="btn btn-custom">Simpan</button>
            </form>
        </div>
    </div>

    <!-- Keuangan Table -->
    <h2 class="mt-5">Daftar Kas Keuangan</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include 'koneksi.php';
            $query = "SELECT * FROM kas_keuangan ORDER BY id ASC";
            $result = mysqli_query($conn, $query);
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
                            <button class='btn btn-warning' onclick='openEditModal({$row['id']}, \"{$row['tanggal']}\", \"{$row['uraian']}\", {$row['qty']}, \"{$row['satuan']}\", \"{$row['deskripsi']}\", {$row['uang_masuk']}, {$row['uang_keluar']})'>Edit</button> 
                            <button class='btn btn-danger-custom' onclick='openDeleteModal({$row['id']})'>Delete</button>
                        </td>
                    </tr>";
                $prevSaldo = $saldo;
                $no++;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('edit')">&times;</span>
        <h2>Edit Data Keuangan</h2>
        <form method="POST" action="update_keuangan.php">
            <input type="hidden" id="edit_id" name="id">
            <label>Tanggal:</label>
            <input type="date" id="edit_tanggal" name="tanggal" required><br>

            <label>Uraian:</label>
            <input type="text" id="edit_uraian" name="uraian" required><br>

            <label>Qty:</label>
            <input type="number" id="edit_qty" name="qty" required><br>

            <label>Satuan:</label>
            <input type="text" id="edit_satuan" name="satuan" required><br>

            <label>Deskripsi:</label>
            <input type="text" id="edit_deskripsi" name="deskripsi" required><br>

            <label>Jenis Transaksi:</label>
            <select id="edit_jenis_transaksi" name="jenis_transaksi" required>
                <option value="masuk">Uang Masuk</option>
                <option value="keluar">Uang Keluar</option>
            </select><br>

            <label>Satuan (Harga per Unit):</label>
            <input type="number" id="edit_harga_satuan" name="harga_satuan" step="0.01" required><br>

            <button type="submit" class="btn btn-custom">Simpan</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Open modal
    function openModal(type) {
        document.getElementById(type + 'Modal').style.display = "block";
    }

    // Close modal
    function closeModal(type) {
        document.getElementById(type + 'Modal').style.display = "none";
    }

    // Open Edit Modal with data
    function openEditModal(id, tanggal, uraian, qty, satuan, deskripsi, uangMasuk, uangKeluar) {
        document.getElementById('editModal').style.display = "block";
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_tanggal').value = tanggal;
        document.getElementById('edit_uraian').value = uraian;
        document.getElementById('edit_qty').value = qty;
        document.getElementById('edit_satuan').value = satuan;
        document.getElementById('edit_deskripsi').value = deskripsi;
        document.getElementById('edit_jenis_transaksi').value = uangMasuk ? 'masuk' : 'keluar';
        document.getElementById('edit_harga_satuan').value = uangMasuk ? uangMasuk : uangKeluar;
    }

    // Open Delete Modal
    function openDeleteModal(id) {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            window.location.href = 'hapus_keuangan.php?id=' + id;
        }
    }
</script>

</body>
</html>
