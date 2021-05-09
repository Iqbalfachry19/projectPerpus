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
$sql = "update pinjam set kt = 'sudah konfirmasi' where kode_pinjam = $id";

if (mysqli_multi_query($conn, $sql) > 0) {
    echo "<script>
    alert('berhasil konfirmasi');
    document.location.href = 'peminjaman.php';
</script>
";
} else {
    echo "<script>
    alert('gagal konfirmasi');
    document.location.href = 'peminjaman.php';
</script>
";
}
$today = date("Y-m-d");
$sql =  "insert into laporan values('','$id',0,'$user','$buku','$today','',0,'belum kembali')";
$cek = mysqli_query($conn, "SELECT * FROM laporan WHERE id_pinjam = '$id'");
$match  = mysqli_num_rows($cek);
if ($match > 0) {
    echo "<script>
        alert('sudah pernah meminta peminjaman buku yang sama!');
        document.location.href = 'daftar-bukua.php';
    </script>";
} else {
    mysqli_multi_query($conn, $sql);
    echo "<script>
    alert('berhasil konfirmasi');
    document.location.href = 'peminjaman.php';
</script>
";
}

mysqli_close($conn);
