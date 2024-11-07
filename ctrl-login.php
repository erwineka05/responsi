<?php
session_start();
require 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

if (!empty($username) && !empty($password)) {
    $query = mysqli_query($sambung, "SELECT * FROM users WHERE username= '$username' AND password='$password'");
    $result = mysqli_num_rows($query);

    $data = mysqli_fetch_array($query);
    if ($data) {
        $_SESSION['status'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $data['level'];

        if ($data['level'] == 'admin') {
            header("Location: home.php");
        } elseif ($data['level'] == 'dosen') {
            header("Location: hm-dosen.php");
        } elseif ($data['level'] == 'siswa') {
            header("Location: hm-siswa.php");
        }
    } else {
        $_SESSION["error"] = "Username atau Password anda salah";
        header("location:login.php?pesan=gagal");
    }
} else {
    $_SESSION["error"] = "Username atau Password tidak boleh kosong";
    header("location:login.php?pesan=error");
}
?>