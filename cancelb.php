<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}
require 'functions.php';
$id = $_GET["id"];
$idb =  $_GET["buku"];
if (cancelb($id) > 0) {
 
    if($_SESSION['level']=="admin"){
    echo "<script>
    alert('data berhasil dicancel');
    document.location.href ='pengembalian.php';
    </script>
    ";}else{
        echo "<script>
        alert('data berhasil dicancel');
        document.location.href ='pengembaliana.php';
        </script>    
        "; }
} else {
    if($_SESSION['level']=="admin"){
    echo "<script>
    alert('sudah konfirmasi tidak bisa cancel');
    document.location.href ='pengembalian.php';
    </script>
    ";}else{
        echo "<script>
        alert('sudah konfirmasi tidak bisa cancel');
        document.location.href ='pengembaliana.php';
        </script>    
        "; }
}
