<?php
session_start();
$akses = @$_SESSION['status'];
if (!isset($_SESSION['status']) || $akses!=true || $_SESSION['level'] != 'admin'){
    header("location:login.php?pesan=belum_login");
}
 
require "config.php";

if (isset($_POST['add_user'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $level = $_POST['level'];

    // Query untuk menambahkan pengguna baru
    $sql_add = "INSERT INTO users (nama, username, password, alamat, telepon, level) VALUES ('$nama', '$username', '$password', '$alamat', '$telepon', '$level')";
    if (mysqli_query($sambung, $sql_add)) {
        echo "<p>Pengguna baru berhasil ditambahkan!</p>";
    } else {
        echo "<p>Gagal menambahkan pengguna baru.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <style>
        body{
            background-color:#0d0b2a;
        }

        h1 {
            text-align: center;
            color:white;
        }
        button {
            padding: 10px;
            background-color: #FF4B4B;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container {
            background-color:orange;
            padding: 20px;
            border-radius: 10px;
            width: 60%;
            margin: 0 auto;
        }
        .form-container label {
            display: block;
            width: 100%;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        .form-container input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container .form-actions {
            display: flex;
            justify-content: space-between;
        }
        .form-container .form-actions button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .form-container .submit-btn {
            background-color: #5cb85c;
            color: white;
        }
        .table-container {
            width: 70%;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border-radius: 10px;
            overflow-x: auto;
            overflow-y: auto;
            max-height: 400px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        th, td {
            padding: 10px;
            border: 1px solid #000000;
        }
        th {
            background-color: #8a2be2;
            color: black;
        }
        h6 {
            padding: 5px;
            margin:auto;
            background-color: #FF4B4B;
            color: white;
            border: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Selamat Datang, Admin <?PHP echo $_SESSION['username']; ?></h1>
    <a href="logout.php"><button class="button">LOGOUT</button></a>
    
    <div class="form-container">
        <form action="" method="POST">
            <label>Nama</label>
            <input type="text" name="nama" required>
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <label>Alamat</label>
            <input type="text" name="alamat">
            <label>Telepon</label>
            <input type="text" name="telepon">
            <label>Level</label>
            <select name="level" required>
                <option value="admin">ADMIN</option>
                <option value="dosen">DOSEN</option>
                <option value="siswa">MAHASISWA</option>
            </select>
            <button type="submit" name="add_user" class="submit-btn">Tambah Data</button>
        </form>
    </div>

    <table border=1 class="table-container">
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM users";
            $query = mysqli_query($sambung, $sql);
            $i = 1;
            while ($datauser = mysqli_fetch_array($query))
            {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>". $datauser["nama"] . "</td>";
                echo "<td>". $datauser["username"] . "</td>";
                echo "<td>". $datauser["password"] . "</td>";
                echo "<td>". $datauser["alamat"] . "</td>";
                echo "<td>". $datauser["telepon"] . "</td>";
                echo "<td>". $datauser["level"] . "</td>";
                echo "<td>";
                echo "<h6><a href=./del-nilai.php?username=$datauser[username]>Hapus</a></h6>";
                echo "</td>";
                echo "</tr>";
                $i++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>

