<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'functions.php';
include('conn.php');
// menangkap data yang dikirim dari form login

$username = $_POST['username'];
$password = hash('md5', $_POST['password']);


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn, "select * from user where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if ($cek > 0) {

    $data = mysqli_fetch_assoc($login);

    // cek jika user login sebagai admin
    if ($data['level'] == "anggota") {

        // buat session login dan username
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "anggota";
        if (isset($_POST['remember'])) {

            setcookie('id', $data["id"], time() + 600);
            setcookie('key', hash('sha256', $data["username"]), time() + 600);
        }
        $sub_query = "
        INSERT INTO login_details 
        (user_id) 
        VALUES ('" . $data['id'] . "')
        ";
        $statement = $connect->prepare($sub_query);
        $statement->execute();
        $_SESSION['login_details_id'] = $connect->lastInsertId();
        // alihkan ke halaman dashboard admin
        header("location:halaman_anggota.php");

        // cek jika user login sebagai pegawai

    } else {

        // alihkan ke halaman login kembali
        header("location:anggota-login.php?pesan=gagal");
    }
} else {
    header("location:anggota-login.php?pesan=gagal");
}
