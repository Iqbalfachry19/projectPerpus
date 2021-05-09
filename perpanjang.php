<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}
require 'functions.php';
$id = $_GET["id"];
$user = $_GET["user"];
$buku = $_GET["buku"];
$cek = mysqli_query($conn, "SELECT * FROM kembali WHERE id_pinjam= '" . $id . "'  ");
$match  = mysqli_num_rows($cek);
$cek1 = mysqli_query($conn, "SELECT * FROM pinjam WHERE kode_pinjam= '" . $id . "' && kt='pending'");
$match1  = mysqli_num_rows($cek1);
if ($match > 0) {
    echo "<script>
        alert('tidak bisa memperpanjang karena sudah dikembalikan!');
        document.location.href = 'peminjamana.php';
    </script>";
    exit;
}
if ($match1 > 0) {
    echo "<script>
        alert('tidak bisa status masih pending!');
        document.location.href = 'peminjamana.php';
    </script>";
    exit;
} else {
    $today = date("Y-m-d");
    $date = strtotime("+7 day");
    $sday = date('Y-m-d', $date);

    $query = "update pinjam set tanggal_hrskembali='$sday' where kode_pinjam=$id";
    mysqli_query($conn, $query);
    echo "<script>
    alert('berhasil perpanjang');
    document.location.href = 'peminjamana.php';
</script>
";
    exit;
}
