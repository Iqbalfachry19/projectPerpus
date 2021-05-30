<?php
session_start();
if (!isset($_GET['id'])){
    header('Location: daftar-anggota.php',true,301); 
    exit();
}


if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}
require 'functions.php';
$id = $_GET["id"];
if (hapus($id) > 0) {
    echo "<script>
    alert('data berhasil dihapus');
    document.location.href ='daftar-anggota.php';
    </script>
    ";
} else {
    echo "<script>
    alert('data gagal dihapus');
    document.location.href ='daftar-anggota.php';
    </script>
    ";
}
