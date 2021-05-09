<?php
$thisPage = "Pengembalian";
session_start();
$user = $_SESSION['username'];
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

require "functions.php";
$pinjam = query("select * from kembali");
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



<?php include 'template/navbar.php'; ?>
    <h1><?php echo $thisPage; ?></h1>

    <p> disini anda bisa melihat pengembalian</p>
    <table id="customers">
        <tr>
            <th>No</th>
            <th>id pinjam</th>
            <th>username</th>
            <th>id buku</th>
            <th>tanggal harus kembali</th>
            <th>tanggal kembali</th>
            <th>denda</th>
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
                <td><a href="peminjaman.php?id=<?=
                                                $row["id_pinjam"]; ?>"><?=
                                                                        $row["id_pinjam"]; ?></a></td>
                <td><a href="daftar-anggota.php?id=<?= $row["username"]; ?>"><?=
                                                                                $row["username"]; ?></a></td>
                <td><a href="daftar-buku.php?id=<?= $row["id_buku"]; ?>"><?=
                                                                            $row["id_buku"]; ?></td>
                <td><?=
                    $row["tanggal_pinjam"]; ?></td>
                <td><?=
                    $row["tanggal_kembali"]; ?></td>
                <td><?=
                    $row["denda"]; ?></td>
                <td><?=
                    $row["keterangan"]; ?></td>
                <td class="aksi">
                    <a style="text-decoration: none;" class="btn btn-info" href="confirm.php?idp=<?= $row["id_pinjam"]; ?>&&id=<?= $row["id_kembali"]; ?>&&user=<?= $row["username"]; ?>&&denda=<?= $row["denda"]; ?>&&buku=<?= $row["id_buku"]; ?>" onclick="return confirm('apa mau dikonfirmasi?');">confirm</a>
                    <a style="text-decoration: none;" class="btn btn-danger" href="cancelb.php?idp=<?= $row["id_pinjam"]; ?>&&id=<?= $row["id_kembali"]; ?>&&user=<?= $row["username"]; ?>&&denda=<?= $row["denda"]; ?>&&buku=<?= $row["id_buku"]; ?>" onclick="return confirm('apa mau dicancel?');">cancel</a>

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