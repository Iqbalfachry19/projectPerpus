<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}
require 'functions.php';
$id = $_GET["id"];
$user = $_GET["user"];
$cek = mysqli_query($conn, "SELECT * FROM daftar_buku WHERE id='$id' && jumlah = 0  ");
$match  = mysqli_num_rows($cek);
if ($match > 0) {
    echo "<script>
        alert('buku tidak tersedia!');
        document.location.href = 'daftar-bukua.php';
    </script>";
    exit;
}
$cek = mysqli_query($conn, "SELECT * FROM laporan WHERE username = '$user' && id_buku = '" . $id . "' && keterangan = 'belum kembali' ");
$match  = mysqli_num_rows($cek);
if ($match > 0) {
    echo "<script>
        alert('kembalikan buku terlebih dahulu!');
        document.location.href = 'daftar-bukua.php';
    </script>";
    exit;
}
$cek = mysqli_query($conn, "SELECT * FROM pinjam WHERE username = '$user' && id_buku = '" . $id . "' && kt = 'pending' ");
$match  = mysqli_num_rows($cek);
if ($match > 0) {
    echo "<script>
        alert('sudah pernah meminta peminjaman buku yang sama!');
        document.location.href = 'daftar-bukua.php';
    </script>";
} else {
    $today = date("Y-m-d");

    $date = strtotime("+7 day");
    $sday = date('Y-m-d', $date);
    $query = "insert into pinjam values('','$user',$id,'$today','$sday',1,'pending')";
    mysqli_query($conn, $query);
    $query = "update daftar_buku set jumlah = jumlah - 1 where id ='$id'";
    mysqli_query($conn, $query);
    echo "<script>
    alert('berhasil meminjam silahkan datang ke perpus untuk mengambil buku');
    document.location.href = 'peminjamana.php';
</script>
";
    exit;
}
