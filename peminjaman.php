<?php
$thisPage = "Peminjaman";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:index.php");
    exit;
}
if (isset($_SESSION['level'])) {
    // jika level admin
    if ($_SESSION['level'] == "admin") {
    }
    // jika kondisi level user maka akan diarahkan ke halaman lain
    else if ($_SESSION['level'] == "anggota") {
        header('location:halaman_anggota.php');
    }
}
$user = $_SESSION['username'];
require "functions.php";
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Getting parameter value inside PHP variable
    $pinjam = query("select * from pinjam where kode_pinjam =$id");
} else {
    $pinjam = query("select * from pinjam");
}

?>
<!DOCTYPE html>
<html>

<head>
<noscript><meta http-equiv="refresh" content="0; url=script-disable.php"/></noscript>
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


<?php include 'template/navbar.php'; ?>
    <h1><?php echo $thisPage; ?></h1>

    <p>Disini anda bisa konfirmasi peminjaman anggota</p>
    <table id="customers">
        <tr>
            <th>No</th>
            <th>username</th>
            <th>id buku</th>
            <th>tanggal pinjam</th>
            <th>tanggal harus kembali</th>
            <th>jumlah</th>
            <th>keterangan</th>
            <th class="aksi">Aksi</th>
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
                <td><a href="daftar-anggota.php?id=<?=
                                                    $row["username"]; ?>"><?=
                                                                            $row["username"]; ?></a></td>
                <td><a href="daftar-buku.php?id=<?= $row["id_buku"]; ?>"><?=
                                                                            $row["id_buku"]; ?></a></td>
                <td><?=
                    $row["tanggal_pinjam"]; ?></td>
                <td><?=
                    $row["tanggal_hrskembali"]; ?></td>
                <td><?=
                    $row["jumlah"]; ?></td>
                <td><?=
                    $row["kt"]; ?></td>
                <td class="aksi">
                    <a style="text-decoration: none;" class="btn btn-info" href="pilih.php?id=<?= $row["kode_pinjam"]; ?>&&user=<?= $row["username"]; ?>&&buku=<?= $row["id_buku"]; ?>" onclick="return confirm('apa mau dikonfirmasi?');">confirm</a>
                    <a style="text-decoration: none;" class="btn btn-danger" href="cancel.php?id=<?= $row["kode_pinjam"]; ?>&&user=<?= $row["username"]; ?>&&buku=<?= $row["id_buku"]; ?>" onclick="return confirm('apa mau dicancel?');">cancel</a>

                </td>
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