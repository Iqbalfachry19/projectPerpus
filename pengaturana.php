<?php
$thisPage = "Pengaturan";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:index.php");
    exit;
}
$user = $_SESSION['username'];
if (isset($_SESSION['level'])) {
    // jika level admin
    if ($_SESSION['level'] == "anggota") {
    }
    // jika kondisi level user maka akan diarahkan ke halaman lain
    else if ($_SESSION['level'] == "admin") {
        header('location:halaman_admin.php');
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $thisPage; ?></title>
    <link rel="stylesheet" href="style_ada.css">
    <link rel="icon" href="favicon.ico" type="image/ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    <center><a style="text-decoration:none" class="btn btn-info" href="ubah-a.php?id=<?php
                                    echo $_SESSION['user_id'];
                                    ?>">Ubah data user</a></center>
    <div class="footer">
        <p>made by iqbalfachry </p>
    </div>
    <script src="script.js">

    </script>
</body>

</html>