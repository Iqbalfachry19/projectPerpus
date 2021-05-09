<?php
session_start();
$thisPage = "Halaman Anggota";
if (!isset($_SESSION['username'])) {
    header("Location:index.php");
    exit;
}
if (isset($_SESSION['level'])) {
    // jika level admin
    if ($_SESSION['level'] == "anggota") {
    }
    // jika kondisi level user maka akan diarahkan ke halaman lain
    else if ($_SESSION['level'] == "admin") {
        header('location:halaman_admin.php');
    }
}

$user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $thisPage; ?></title>
    <link rel="stylesheet" href="style_ada.css">
    <link rel="icon" href="favicon.ico" type="image/ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .box {
            width: 400px;
            height: auto;
            border: 2px solid #000;
            margin: 0 auto 15px;
            text-align: center;
            padding: 20px;
            font-weight: bold;
            border-radius: 10px;
        }

        .info {
            background-color: #ddd;
            border-color: #aaa;
        }
    </style>
</head>

<body>
    <?php


    // cek apakah yang mengakses halaman ini sudah login
    if ($_SESSION['level'] == "") {
        header("location:index.php?pesan=gagal");
    }

    ?>



<?php include 'template/navbara.php'; ?>
    <h1><?php echo $thisPage; ?></h1>

    <p>Halo <b><?php echo $_SESSION['username']; ?></b> Anda telah login sebagai <b><?php echo $_SESSION['level']; ?></b>.</p>

    <p style="font-weight: bold; font-size:large"> Informasi & kebijakan</p>
    <div class="info box">
        <p>Anda bisa melihat Daftar Buku, Peminjaman, Pengembalian</p>
        <ol style="padding-left: 70px;">
            <li style="padding-right: 70px;">jam operasi : 08.00AM - 10.00PM</li>
            <li style="padding-right: 70px;">biaya denda 200rp/hari</li>
            <li style="padding-right: 70px;">lama peminjaman 7 hari</li>

        </ol>

    </div>
    <div class="footer">
        <p>made by iqbalfachry </p>
    </div>
    <script src="script.js">

    </script>

</body>

</html>