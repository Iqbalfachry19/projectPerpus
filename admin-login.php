<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location:halaman_admin.php");
    exit;
}
?>
<html>

<head>
    <title>Login Admin</title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="styless.css">
</head>

<body>

    <h1>Login Admin</h1>

    <?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
            echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
        }
    }
    ?>

    <div class="kotak_login">
        <p class="tulisan_login">Silahkan login</p>

        <form action="cek_login_admin.php" method="post">
            <label>Username</label>
            <input type="text" name="username" class="form_login_nama" placeholder="Username .." required="required">

            <label>Password</label>
            <input type="password" name="password" class="form_login" placeholder="Password .." required="required">
            <input type="checkbox" onclick="myFunction()" class="form-checkbox"> Show password
            <br />
            <br />
            <input type="checkbox" name="remember" id="remember" class="form-checkbox-remember"> Remember Me
            <br />
            <br />

            <input type="submit" class="tombol_login" value="LOGIN">

            <br />
            <br />
            <center>
                <a class="link" href="index">kembali</a>
            </center>
        </form>

    </div>


</body>
<script type="text/javascript">
    function myFunction() {
        var x = document.getElementsByClassName("form_login")[0];
        console.log(x);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

</html>