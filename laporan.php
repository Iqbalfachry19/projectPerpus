<?php
$thisPage = "Laporan";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:index.php");
    exit;
}
$user = $_SESSION['username'];
require "functions.php";

?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $thisPage; ?></title>
    <link rel="stylesheet" href="style_ada.css">
    <link rel="stylesheet" href="style_tab.css">
    <link rel="icon" href="favicon.ico" type="image/ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <?php


    // cek apakah yang mengakses halaman ini sudah login
    if ($_SESSION['level'] == "") {
        header("location:index.php?pesan=gagal");
    }

    ?>



<?php include 'template/navbar.php'; ?>
    <h1><?php echo $thisPage; ?></h1>

    <p>disini anda bisa lihat Laporan</p>

    <?php
    $today = date("Y-m-d");
    ?>
    <center> <select class="form-control" name="s_jurusan" id="s_jurusan">
            <option value="">pilih laporan...</option>
            <option value="a">tampilkan semua data</option>
            <option value="b">lihat berdasarkan hari ini</option>
            <option value="c">lihat berdasarkan minggu ini</option>
            <option value="d">lihat berdasarkan bulan ini</option>
            <option value="e">lihat berdasarkan tahun ini</option>
            <option value="f">lihat berdasarkan telat</option>
            <option value="g">lihat berdasarkan tidak telat</option>
            <option value="h">lihat berdasarkan belum kembali</option>
        </select>
    </center>
    <div class="data"></div>
    <div class="footer">
        <p>made by iqbalfachry </p>
    </div>
    <script src="script.js">

    </script>
    <script>
        $(document).ready(function() {
            load_data();

            function load_data(jurusan, keyword) {
                $.ajax({
                    method: "POST",
                    url: "data.php",
                    data: {
                        jurusan: jurusan,
                        keyword: keyword
                    },
                    success: function(hasil) {
                        $('.data').html(hasil);
                    }
                });
            }
            $('#s_keyword').keyup(function() {
                var jurusan = $("#s_jurusan").val();
                var keyword = $("#s_keyword").val();
                load_data(jurusan, keyword);
            });
            $('#s_jurusan').change(function() {
                var jurusan = $("#s_jurusan").val();
                var keyword = $("#s_keyword").val();
                load_data(jurusan, keyword);
            });
        });
    </script>
</body>

</html>