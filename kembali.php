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
if ($match1 > 0) {
    echo "<script>
        alert('tidak bisa status masih pending!');
        document.location.href = 'peminjamana.php';
    </script>";
    exit;
}
if ($match > 0) {
    echo "<script>
        alert('sudah meminta pengembalian!');
        document.location.href = 'peminjamana.php';
    </script>";
} else {
    $today = date("Y-m-d");
    $date = strtotime("+7 day");
    $sday = date('Y-m-d', $date);
    $tgl = $_GET["tgl"];
    $tglp = date_create($_GET["tgl"]);
    $t = date_create(date("Y-m-d"));
    $terlambat = date_diff($tglp, $t);
    $hari = $terlambat->format("%R%a");

    if ($hari <= 0) {
        $denda = 0;
    } else {
        $denda = $hari * 200;
    }

    $query = "insert into kembali values('',$id,'$user','$buku','$tgl','$today','$denda','pending')";
    mysqli_query($conn, $query);
    echo "<script>
    alert('berhasil meminta pengembalian silahkan balikan buku ke perpus');
    document.location.href = 'pengembaliana.php';
</script>
";
    exit;
}
