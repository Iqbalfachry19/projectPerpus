<?php
require 'functions.php';

$id = $_GET["id"];
$row = query("select * from daftar_buku where id = $id")[0];
if (isset($_POST['submit'])) {
    $judul = $_POST["judul"];
    $sql_u = "SELECT * FROM daftar_buku WHERE judul='$judul' && id != $id";
    $res_u = mysqli_query($conn, $sql_u);
    // cek apakah username dan password di temukan pada database
    if (mysqli_num_rows($res_u) > 0) {
        $name_error = "Maaf .. judul sudah ada";
        echo '<script>alert("' . $name_error . '");</script>';
    } else {

        if (ubah($_POST) > 0) {
            echo "<script>
        alert('data berhasil diubah');
        document.location.href ='daftar-buku.php';
        </script>
        ";
        } else {
            echo "<script>
        alert('data tidak diubah');
        document.location.href ='daftar-buku.php';
        </script>
        ";
        }
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
    <title>Ubah Buku</title>
</head>

<body>
    <h1>Ubah Buku</h1>
    <div class="kotak_login">

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $row["id"]; ?>">
            <input type="hidden" name="gambarLama" value="<?= $row["sampul"]; ?>">
            <label for="judul" name="judul">Judul</label>
            <input required="required" value="<?= $row["judul"]; ?>" class="form_login_nama" type="text" name="judul" id="judul">
            <label for="penulis" name="penulis">Penulis</label>
            <input value="<?= $row["penulis"]; ?>" class="form_login_nama" type="text" name="penulis" id="penulis">
            <label for="penerbit" name="penerbit">Penerbit</label>
            <input value="<?= $row["penerbit"]; ?>" class="form_login_nama" style="display:block;" type="text" name="penerbit" id="penerbit">
            <label for="jumlah" name="jumlah">Jumlah Buku</label>
            <input value="<?= $row["jumlah"]; ?>" class="form_login_nama" style="display:block;" type="text" name="jumlah" id="jumlah">
            <label for="kategori" name="kategori">Kategori</label>
            <input value="<?= $row["kategori"]; ?>" class="form_login_nama" style="display:block;" type="text" name="kategori" id="kategori">
            <label style="display:block;" for="sampul" name="sampul">Sampul</label>
            <img src="img/<?= $row["sampul"]; ?>" alt="" width="40"><br>
            <input type="file" name="sampul" id="sampul">
            <button class="tombol_login" type="submit" name="submit">Ubah</button>

            <br />
            <br />
            <center>
                <a class="link" href="daftar-buku.php">kembali</a>
            </center>
        </form>

    </div>
</body>

</html>