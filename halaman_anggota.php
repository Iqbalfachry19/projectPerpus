<?php
session_start();
require "functions.php";
$thisPage = "Halaman Anggota";
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    $result = mysqli_query($conn, "select * from user where id= $id");
    $row = mysqli_fetch_assoc($result);
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION["username"] = $row['username'];
        $_SESSION["level"] = $row['level'];
    }
}
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
$sql=mysqli_query($conn,"select count(username) from user where level = 'anggota'");
$r=mysqli_fetch_row($sql);
$sql=mysqli_query($conn,"select count(judul) from daftar_buku ");
$r1=mysqli_fetch_row($sql);
$sql=mysqli_query($conn,"select count(username) from pinjam where kt = 'sudah konfirmasi' && username = '$user' ");
$r2=mysqli_fetch_row($sql);
$sql=mysqli_query($conn,"select count(username) from kembali where keterangan = 'sudah konfirmasi'  && username = '$user' ");
$r3=mysqli_fetch_row($sql);

?>
<!DOCTYPE html>
<html>

<head>
<noscript><meta http-equiv="refresh" content="0; url=script-disable.php"/></noscript>
    <title><?php echo $thisPage; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .box-300 {
            width: 300px;
            height: auto;
            border: 2px solid #000;
            margin: 0 auto 15px;
            text-align: center;
            padding: 20px;
            font-weight: bold;
            border-radius: 10px;
            display: flex;
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
    <div class="container" style="display:flex; justify-content:space-between">
    <div class="info box-300" style="justify-content:space-between">
    <div style="display:flex; ">
    <img src="img/orang.svg" style="width:50px;"/>
    </div>
    <div style="display:flex;   flex-direction:column ">
  <p><?= $r[0]; ?></p>
  <p>total anggota</p>
    </div>
    </div>
    
    <div class="info box-300" style="justify-content:space-between">
    <div style="display:flex; ">
    <img src="img/book.svg" style="width:50px;"/>
    </div>
    <div style="display:flex;   flex-direction:column ">
  <p><?= $r1[0]; ?></p>
  <p>total buku</p>
    </div>
    </div>
    <div class="info box-300" style="justify-content:space-between">
    <div style="display:flex; ">
    <img src="img/pinjam.svg" style="width:50px;"/>
    </div>
    <div style="display:flex;  flex-direction:column ">
  <p><?= $r2[0]; ?></p>
  <p>total peminjaman</p>
    </div>
    </div>
    <div class="info box-300" style="justify-content:space-between">
    <div style="display:flex; ">
    <img src="img/balik.svg" style="width:50px;"/>
    </div>
    <div style="display:flex;  flex-direction:column ">
  <p><?= $r3[0]; ?></p>
  <p>total pengembalian</p>
    </div>
    </div>
    </div>
    <div class="footer">
        <p>made by iqbalfachry </p>
    </div>
    <script src="script.js">

    </script>

</body>

</html>