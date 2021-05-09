<?php
include 'functions.php';
if (isset($_POST['submit'])) {
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $password = md5($_POST['password']);
    $password1 = $_POST['password'];
    $sql_u = "SELECT * FROM user WHERE username='$username'";
    $res_u = mysqli_query($conn, $sql_u);
    // cek apakah username dan password di temukan pada database


    //mengambil inputan dari form dengan name password
    $password2 = $_POST['password2']; //mengambil inputan dari form dengan name password2

    if ($password1 == $password2) { // kondisi jika password = password2
        if (mysqli_num_rows($res_u) > 0) {
            $name_error = "Maaf .. username sudah ada";
            echo '<script>alert("' . $name_error . '");</script>';
        } else {
            $daftar = mysqli_query($conn, "insert into user values('','$nama','$username','$password','anggota')");

            echo "<script>alert('berhasil tambah user');
            window.location.href='anggota-login.php';</script>";
            exit();
        }
    } else { // sebaliknya, jika password tidak sama dengan password 2
        echo "<script>alert('Maaf password anda tidak sama, silahkan coba lagi');</script>"; //tamplikan error
    }
}
