<?php
require 'functions.php';
if (isset($_POST['submit'])) {
    $penerbit = $_POST["penerbit"];
    $penulis = $_POST["penulis"];
    $judul = $_POST["judul"];
    $jumlah = $_POST["jumlah"];
    $kategori = $_POST["kategori"];
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $sql_u = "SELECT * FROM daftar_buku WHERE judul='$judul'";
    $res_u = mysqli_query($conn, $sql_u);
    // cek apakah username dan password di temukan pada database
    if (mysqli_num_rows($res_u) > 0) {
        $name_error = "Maaf .. judul sudah ada";
        echo '<script>alert("' . $name_error . '");</script>';
    } else {
        $daftar = mysqli_query($conn, "insert into daftar_buku values('','$judul','$penulis','$penerbit','$gambar','$kategori',$jumlah)");

        echo "<script>alert('berhasil tambah buku');
        window.location.href='daftar-buku.php';</script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styless.css">
    <title>Buat Buku</title>
</head>

<body>
    <h1>Buat Buku</h1>
    <div class="kotak_login">

        <form action="" method="post" enctype="multipart/form-data">
            <label for="judul" name="judul">Judul</label>
            <input required="required" placeholder="masukkan judul" class="form_login_nama" type="text" name="judul" id="judul">
            <label for="penulis" name="penulis">Penulis</label>
            <input placeholder="masukkan penulis" class="form_login_nama" type="text" name="penulis" id="penulis">
            <label for="penerbit" name="penerbit">Penerbit</label>
            <input placeholder="masukkan penerbit" class="form_login_nama" style="display:block;" type="text" name="penerbit" id="penerbit">
            <label for="jumlah" name="jumlah">Jumlah Buku</label>
            <input placeholder="masukkan jumlah" class="form_login_nama" style="display:block;" type="text" name="jumlah" id="jumlah">
            <label for="kategori" name="kategori">Kategori</label>
            <input placeholder="masukkan kategori" class="form_login_nama" style="display:block;" type="text" name="kategori" id="kategori">
            <label for="sampul" name="sampul">Sampul</label>
            <input class="form_login_nama" type="file" name="sampul" id="sampul">
            <button class="tombol_login" type="submit" name="submit">Buat</button>

            <br />
            <br />
            <center>
                <a class="link" href="daftar-buku.php">kembali</a>
            </center>
        </form>

    </div>
</body>

</html>