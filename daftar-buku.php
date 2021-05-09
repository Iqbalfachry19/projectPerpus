<?php
$thisPage = "Daftar Buku";
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

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Getting parameter value inside PHP variable
    $mahasiswa = query("select * from daftar_buku where id = $id");
} else {
    $mahasiswa = query("select * from daftar_buku");
}
if (isset($_POST["cari"])) {
    if (isset($_POST["cari"])) {
        $mahasiswa = carib($_POST["keyword"]);
        $keyword = $_POST['keyword'];
        $result = mysqli_query($conn, "select * from daftar_buku where  judul like '%$keyword%' ");
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



<?php include 'template/navbar.php'; ?>
    <h1><?php echo $thisPage; ?></h1>

    <p>disini anda bisa semua melihat daftar buku yang ada di perpustakaan</p>
    <center><a style="text-decoration: none;" class="btn btn-info" href="buat-buku.php">buat buku</a></center> <br>
    <form action="" method="post" class="form-cari">

        <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off" id="keyword">

        <button type="submit" name="cari" id="tombol-cari"><i style="padding-right:10px;" class="fa fa-search"></i></button>
    </form>
    <table id="customers">
        <tr>
            <th>No</th>
            <th>Sampul</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th class="aksi">Aksi</th>
        </tr>
        <?php
        $i = 1;
        ?>
        <?php
        foreach ($mahasiswa as $row) :
        ?>
            <tr>
                <td><?=
                    $i; ?></td>
                <td><img src="img/<?=
                                    $row["sampul"]; ?>" width="100px" alt=""></td>
                <td><?=
                    $row["judul"]; ?></td>
                <td><?=
                    $row["penulis"]; ?></td>
                <td><?=
                    $row["penerbit"]; ?></td>
                    <td><?=
                    $row["kategori"]; ?></td>
<td><?=
                    $row["jumlah"]; ?></td>
                <td class="aksi">
                    <a style="text-decoration: none;" class="btn btn-warning" href="ubah-buku.php?id=<?= $row["id"]; ?>">ubah</a>
                    <a style="text-decoration: none;" class="btn btn-danger" href="hapusb.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
                </td>
            </tr>
            <?php
            $i++;
            ?>
            <?php
        endforeach;
            ?><?php if (isset($_POST["cari"])) {
                    if (mysqli_num_rows($result) == 0) {
                        $error = "no data";
                ?></tr>
            <td colspan='9'><?=
                            $error; ?></td>
            </tr>
        <?php } ?>
    <?php
                } ?>
    </table>
    <div class="footer">
        <p>made by iqbalfachry </p>
    </div>
    <script src="script.js">

    </script>



</body>

</html>