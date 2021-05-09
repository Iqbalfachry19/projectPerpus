<?php
session_start();
require "functions.php";
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

if (isset($_SESSION['username'])) {

    header("Location:halaman_admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/ico">

    <title>Perpustakaan</title>
</head>

<body style=" overflow: hidden; ">
    <div class="logo">
        <img data-aos="fade-down"  data-aos-duration="1000" src="img/books-stack-of-three_1.png">
        <h1 class="judulawal" data-aos="fade-up" data-aos-duration="1000">PERPUSTAKAAN</h1>
        <h2  class="juduldua"data-aos="fade-up" data-aos-duration="1000">KELURAHAN SIMPANG BARU</h2>
    </div>
    <div class="container">
        <div class="masuk">
            <br>
            <h3  data-aos="fade-up"  data-aos-duration="1000">MASUK SEBAGAI :</h3><a href=" admin-login">

                <button data-aos="fade-up"  data-aos-duration="1000" id="admin"> <img src="img/administrator-512.png" alt=""><span>ADMIN</span></button>
            </a><a href=" anggota-login">
                <button data-aos="fade-up"  data-aos-duration="1000" class="button-anggota"> <img src="img/pngfind.com-profile-icon-png-1102927.png" alt=""><span>ANGGOTA</span></button>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="daftar">
            <br><br><br>
            <h5 data-aos="fade-up"  data-aos-duration="1000">Belum Punya Akun?</h5>
            <a  href="daftar.php"><button data-aos="fade-up"  data-aos-duration="1000" id="daftar"><Span>DAFTAR</Span></button></a>
        </div>
    </div>
    <footer data-aos="fade-up"  data-aos-duration="1000">
        <br><br>
        <span>IQBALFACHRY<span>
                <h5>| PROJECT PERPUS &copy; 2021</h5>
    </footer>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
  AOS.init();
</script>
</body>

</html>