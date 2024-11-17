<?php
session_start();
if ($_SESSION['role'] !== 'anggota') {
    header('Location: login.php');
    exit;
}
echo "Selamat datang, Anggota " . $_SESSION['username'];
?>
