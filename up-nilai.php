<?php
session_start();
$akses = @$_SESSION['status'];
if (!isset($_SESSION['status']) || $akses != true || $_SESSION['level'] != 'dosen') {
    header("location:login.php?pesan=belum_login");
}

require "config.php";

// Mendapatkan username dari parameter GET
$username = $_GET['username'];

// Mengambil nilai saat ini dari database
$sql = "SELECT nilai FROM users WHERE username = '$username'";
$query = mysqli_query($sambung, $sql);
$data = mysqli_fetch_assoc($query);

// Memeriksa apakah data ditemukan
if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

// Proses pembaruan nilai
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nilai_baru = $_POST['nilai'];

    // Update nilai di database
    $update_sql = "UPDATE users SET nilai = '$nilai_baru' WHERE username = '$username'";
    if (mysqli_query($sambung, $update_sql)) {
        header("Location: hm-dosen.php?pesan=sukses-update");
        exit;
    } else {
        echo "Error: " . mysqli_error($sambung);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Nilai</title>
    <style>
        /* Gaya untuk tampilan halaman */
        body {
            font-family: Arial, sans-serif;
            background-color: #0d0b2a;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            color: #333;
        }
        
        h2 {
            color: #ffffff;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Gaya untuk form dan isinya */
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        label {
            font-size: 1em;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 1em;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: orange;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color:purple;
        }

        /* Gaya untuk link kembali */
        a {
            display: inline-block;
            margin-top: 20px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h2>Update Nilai untuk <?php echo $username; ?></h2>
    <form action="" method="POST">
        <label>Nilai Baru:</label>
        <input type="number" name="nilai" value="<?php echo $data['nilai']; ?>" required>
        <button type="submit">Update</button>
    </form>
    <a href="hm-dosen.php">Kembali</a>

</body>
</html>

