<?php
session_start();
$akses = @$_SESSION['status'];
if (!isset($_SESSION['status']) || $akses != true || $_SESSION['level'] != 'dosen') {
    header("location:home.php?pesan=belum_login");
}

require "config.php";

$username = $_POST['username'];

$sql = "UPDATE users SET nilai = NULL WHERE username = '$username'";
if (mysqli_query($sambung, $sql)) {
    header("Location: hm-dosen.php?pesan=sukses-hapus");
    exit;
} else {
    echo "Error: " . mysqli_error($sambung);
}
?>