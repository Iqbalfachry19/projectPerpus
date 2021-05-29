<?php
$thisPage = "Pengembalian";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:index.php");
    exit;
}
$user = $_SESSION['username'];
require "functions.php";
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Getting parameter value inside PHP variable
    $pinjam = query("select * from kembali where id_pinjam =$id && username ='$user'");
} else {
    $pinjam = query("select * from kembali where username ='$user'");
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
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $thisPage; ?></title>
    <link rel="stylesheet" href="style_ada.css">
    <link rel="stylesheet" href="style_tab.css">
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

    <p> disini anda bisa melihat pengembalian</p>
    <table id="customers">
        <tr>
            <th>No</th>
            <th>id pinjam</th>
            <th>id buku</th>
            <th>tanggal harus kembali</th>
            <th>tanggal kembali</th>
            <th>denda</th>
            <th>keterangan</th>
        </tr>
        <?php
        $i = 1;
        ?>
        <?php
        foreach ($pinjam as $row) :
        ?>
            <tr>
                <td><?=
                    $i; ?></td>
                <td><a href="peminjamana.php?id=<?=
                                                $row["id_pinjam"]; ?>"><?=
                                                                        $row["id_pinjam"]; ?></a></td>

                <td><a href="daftar-bukua.php?id=<?= $row["id_buku"]; ?>"><?=
                                                                            $row["id_buku"]; ?></td>
                <td><?=
                    $row["tanggal_pinjam"]; ?></td>
                <td><?=
                    $row["tanggal_kembali"]; ?></td>
                <td><?=
                    $row["denda"]; ?></td>
                <td><?=
                    $row["keterangan"]; ?></td>
            </tr>
            <?php
            $i++;
            ?>
        <?php
        endforeach;
        ?>
    </table>
    <div class="footer">
        <p>made by iqbalfachry </p>
    </div>
    <script src="script.js">

    </script>


</body>

</html>