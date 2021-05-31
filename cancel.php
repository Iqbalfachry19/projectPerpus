<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}
require 'functions.php';
$id = $_GET["id"];
$idb = $_GET["buku"];
if (cancelp($id) > 0) {
    $query = "update daftar_buku set jumlah = jumlah + 1 where id ='$idb'";
    mysqli_query($conn, $query);
    if($_SESSION['level']=="admin"){
    echo "<script>
    alert('data berhasil dicancel');
    document.location.href ='peminjaman.php';
    </script>
    ";
}else{
    echo "<script>
    alert('data berhasil dicancel');
    document.location.href ='peminjamana.php';
    </script>
    ";
}
} else {
    if($_SESSION['level']=="admin"){
    echo "<script>
    alert('sudah konfirmasi tidak bisa cancel');
    document.location.href ='peminjaman.php';
    </script>
    ";}else{
        echo "<script>
        alert('data berhasil dicancel');
        document.location.href ='peminjamana.php';
        </script>
        ";
    }
}
