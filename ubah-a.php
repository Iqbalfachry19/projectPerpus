<?php
require 'functions.php';

if (!isset($_GET['id'])){
    header('Location: pengaturana.php',true,301); 
    exit();
}
$id = $_GET["id"];
$row = query("select * from user where id = $id")[0];

if (isset($_POST['submit'])) {
    $judul = $_POST["penulis"];
    $sql_u = "SELECT * FROM user WHERE username='$judul' && id != $id";
    $res_u = mysqli_query($conn, $sql_u);
    // cek apakah username dan password di temukan pada database
    if (mysqli_num_rows($res_u) > 0) {
        $name_error = "Maaf .. username sudah ada";
        echo '<script>alert("' . $name_error . '");</script>';
    } else {
        if (ubaha($_POST) > 0) {
            echo "<script>
        alert('data berhasil diubah');
        document.location.href ='pengaturana.php';
        </script>
        ";
        } else {
            echo "<script>
        alert('data tidak diubah');
        document.location.href ='pengaturana.php';
        </script>
        ";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<noscript><meta http-equiv="refresh" content="0; url=script-disable.php"/></noscript>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styless.css">
    <title>Ubah data user</title>
</head>

<body>
    <h1>Ubah data user</h1>
    <div class="kotak_login">

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $row["id"]; ?>">
            <input type="hidden" name="password" value="<?= $row["password"]; ?>">
            <label for="judul" name="judul">Nama</label>
            <input required="required" value="<?= $row["nama"]; ?>" class="form_login_nama" type="text" name="judul" id="judul">
            <label for="penulis" name="penulis">Username</label>
            <input value="<?= $row["username"]; ?>" class="form_login_nama" type="text" name="penulis" id="penulis">
            <label for="penerbit" name="penerbit">Password Baru</label>
            <input placeholder="masukkan password baru" class="form_login_nama" style="display:block;" type="password" name="penerbit" id="penerbit">

            <button class="tombol_login" type="submit" name="submit">Ubah</button>

            <br />
            <br />
            <center>
                <a class="link" href="daftar-anggota.php">kembali</a>
            </center>
        </form>

    </div>
</body>

</html>