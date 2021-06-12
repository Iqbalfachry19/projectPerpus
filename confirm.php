<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}
require 'functions.php';
$id = $_GET["id"];
$idp = $_GET["idp"];
$user = $_GET["user"];
$denda = $_GET["denda"];
$idb = $_GET["buku"];
$tglk = $_GET['tanggal'];
$tgl = date("Y-m-d");
$tglp = date_create($_GET["tanggal"]);
$t = date_create(date("Y-m-d"));
$terlambat = date_diff($tglp, $t);
$hari = $terlambat->format("%R%a");

if ($hari <= 0) {
    $denda = 0;
} else {
    $denda = $denda+($hari * 200);
}

$sql = "update kembali set keterangan = 'sudah konfirmasi', denda = $denda ,tanggal_kembali = '$tgl'  where id_kembali = $id";
$cek1 = mysqli_query($conn, "SELECT * FROM laporan WHERE id_kembali = '$id'");
$match1  = mysqli_num_rows($cek1);
if ($match1 > 0) {
    echo "<script>
        alert('sudah dikonfiramasi!');
        document.location.href = 'daftar-bukua.php';
    </script>";
} 
else{if (mysqli_multi_query($conn, $sql) > 0) {
    echo "<script>
    alert('berhasil konfirmasi');
    document.location.href = 'pengembalian.php';
</script>
";
} else {
    echo 'Error ' . mysqli_error($conn);
    echo "<script>
    alert('gagal konfirmasi);
    document.location.href = 'pengembalian.php';
</script>
";
}
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
if ($denda > 0) {
    $keterangan = 'telat';
} else {
    $keterangan = 'tidak telat';
}
$dendar = rupiah($denda);
$today = date("Y-m-d");
$sql =  "update laporan set denda='$dendar', id_kembali=$id, keterangan='$keterangan', tanggal_kembali='$today' where id_pinjam=$idp";
$cek = mysqli_query($conn, "SELECT * FROM laporan WHERE id_kembali = '$id'");
$match  = mysqli_num_rows($cek);
if ($match > 0) {
    echo "<script>
        alert('sudah pernah meminta pengembalian buku yang sama!');
        document.location.href = 'daftar-bukua.php';
    </script>";
} else {
    mysqli_multi_query($conn, $sql);
    $query = "update daftar_buku set jumlah = jumlah + 1 where id ='$idb'";
    mysqli_query($conn, $query);
    echo "<script>
    alert('berhasil konfirmasi');
    document.location.href = 'pengembalian.php';
</script>
";
}
mysqli_close($conn);
}