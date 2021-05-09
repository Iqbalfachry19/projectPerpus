<div class="navbar">

        <a <?php if ($thisPage == "Halaman Anggota") echo "class='active'"; ?> href="halaman_anggota.php"  style="display:flex;"> <img src="img/home.svg" style="margin-right:10px; align-items: center; display:flex;"  />Beranda</a>
        <a <?php if ($thisPage == "Daftar Buku") echo "class='active'"; ?>href="daftar-bukua.php">Daftar Buku</a>
        <a <?php if ($thisPage == "Peminjaman") echo "class='active'"; ?> href="peminjamana.php">Peminjaman</a>
        <a <?php if ($thisPage == "Pengembalian") echo "class='active'"; ?> href="pengembaliana.php">Pengembalian</a>
        <a <?php if ($thisPage == "Chat") echo "class='active'"; ?> href="chata.php">Chat</a>

        <div class="right">
            <div class="dropdown"> <button class="dropbtn" onclick="myFunction()"> <?=
                                                                                    $user; ?> <i id="icon" class="fa fa-caret-down"></i></button>
                <div class="dropdown-content" id="myDropdown">
                    <a href="logout.php" onclick="return confirm('yakin?');">Logout</a>
                    <a href="pengaturana.php">Pengaturan</a>

                </div>
            </div>
        </div>
    </div>
