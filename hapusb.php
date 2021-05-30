<?php
session_start();
if (!isset($_GET['id'])){
    header('Location: daftar-buku.php',true,301); 
    exit();
}
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}
require 'functions.php';
$id = $_GET["id"];
if (hapusbuku($id) > 0) {
    echo "<script>
    alert('buku berhasil dihapus');
    document.location.href = 'daftar-buku.php';
</script>
";
} else {
    echo "<script>
    alert('buku gagal dihapus');
    document.location.href = 'daftar-buku.php';
</script>
";
}
