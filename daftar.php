<?php include('controller-daftar.php') ?>
<html>

<head>
    <title>Daftar Anggota</title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="styless.css">
</head>

<body>

    <h1>Daftar Anggota</h1>

    <?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
            echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
        }
    }
    ?>

    <div class="kotak_login">
        <p class="tulisan_login">Silahkan Daftar</p>

        <form action="daftar.php" method="post">
            <label>Nama</label>
            <input type="text" name="nama" class="form_login_nama" placeholder="Nama .." required="required">


            <label>Username</label>
            <input type="text" name="username" class="form_login_nama" placeholder="Username .." required="required">


            <label>Password</label>
            <input type="password" name="password" class="form_login" placeholder="Password .." required="required">

            <label>Konfirmasi Password</label> <br />
            <input type="password" name="password2" class="form_login" placeholder="Password .." required="required">
            <input type="checkbox" class="form-checkbox"> Show password
            <br /> <br />
            <input type="submit" name="submit" class="tombol_login" value="Daftar">

            <br />
            <br />
            <center>
                <a class="link" href="index.php">kembali</a>
            </center>
        </form>

    </div>


</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('.form-checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('.form_login').attr('type', 'text');
            } else {
                $('.form_login').attr('type', 'password');
            }
        });
    });
</script>

</html>