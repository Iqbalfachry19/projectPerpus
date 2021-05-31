<?php
$thisPage = "Peminjaman";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:index.php");
    exit;
}
$user = $_SESSION['username'];
require "functions.php";
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Getting parameter value inside PHP variable
    $pinjam = query("select * from pinjam where kode_pinjam =$id && username ='$user'");
} else {
    $pinjam = query("select * from pinjam where username ='$user'");
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
    <noscript><meta http-equiv="refresh" content="0; url=script-disable.php"/></noscript>
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

    <p>Disini anda bisa lihat konfirmasi peminjaman dan mengembalikan buku</p>
    <table id="customers">
        <tr>
            <th>No</th>
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
                <td><a href="daftar-bukua.php?id=<?= $row["id_buku"]; ?>"><?=
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
                    <a style="text-decoration: none;" class="btn btn-info" href="kembali.php?id=<?= $row["kode_pinjam"]; ?>&user=<?= $user; ?>&buku=<?= $row["id_buku"]; ?>&tgl=<?= $row["tanggal_hrskembali"]; ?>" onclick="return confirm('yakin?');">kembalikan</a>
                    <a style="text-decoration: none;" class="btn btn-warning" href="perpanjang.php?id=<?= $row["kode_pinjam"]; ?>&user=<?= $user; ?>&buku=<?= $row["id_buku"]; ?>" onclick="return confirm('yakin?');">perpanjang</a>
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