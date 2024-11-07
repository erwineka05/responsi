<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "db-web";

$sambung = mysqli_connect($server, $username, $password, $database);
if( !$sambung ){
    die("Ada masalah Ada masalah koneksi ke database: ". mysqli_connect_error());
}

/*$username_aplikasi = "admin";
$password_aplikasi = "admin1234";

$username = @$_POST['username'];
$password =@$_POST['password'];
//validasi Input user
if ($username !="" and $username != null and $password != "" and $password != null) {
    if ($username == $username_aplikasi and $password == $password_aplikasi)
    {
        echo "Anda Berhasil Login";
    }else {
        echo "Username atau Password Salah!";
    }
}else {
    echo "username atau password tidak boleh kosong!";
}*/
?>