<?php
session_start();
$akses = @$_SESSION['status'];
if (!isset($_SESSION['status']) || $akses != true || $_SESSION['level'] != 'siswa') {
    header("location:login.php?pesan=belum_login");
}

require "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard-mahasiswa</title>
    <style>
        body {
            background-color: #0d0b2a;
        }

        h1 {
            text-align: center;
            color:#fff;
        }

        button {
            padding: 10px;
            background-color: #FF0000;
            margin-left:10px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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

        th,
        td {
            padding: 10px;
            border: 1px solid #dddddd;
        }

        th {
            background-color: orange;
            color: black;
        }
    </style>
</head>

<body>
    <h1>Selamat Datang, Mahasiswa <?PHP echo $_SESSION['username']; ?></h1>
    <a href="logout.php"><button class="button">LOGOUT</button></a>
    
    <table border=1 class="table-container">
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM users WHERE users.level = 'siswa'";
            $query = mysqli_query($sambung, $sql);
            $i = 1;
            while ($datauser = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>" . $datauser["nama"] . "</td>";
                echo "<td>" . $datauser["username"] . "</td>";
                echo "<td>" . ($datauser["nilai"] != null ? $datauser['nilai'] : 'Belum Ada Nilai') . "</td>";
                echo "</tr>";
                $i++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>