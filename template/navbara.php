<div class="navbar">
<a   href="halaman_anggota.php" style="display:flex;"> DIGITAL PERPUS</a>
        <a <?php if ($thisPage == "Halaman Anggota") echo "class='active'"; ?> href="halaman_anggota.php"  style="display:flex;"> <img src="img/home.svg" style="margin-right:10px; align-items: center; display:flex;"  />Beranda</a>
        <a <?php if ($thisPage == "Daftar Buku") echo "class='active'"; ?>href="daftar-bukua.php" style="display:flex;"> <img src="img/book.svg" style="margin-right:10px; align-items: center; display:flex;"  />Daftar Buku</a>
        <a <?php if ($thisPage == "Peminjaman") echo "class='active'"; ?> href="peminjamana.php" style="display:flex;"> <img src="img/pinjam.svg" style="margin-right:10px; align-items: center; display:flex;"  />Peminjaman</a>
        <a <?php if ($thisPage == "Pengembalian") echo "class='active'"; ?> href="pengembaliana.php"style="display:flex;"> <img src="img/balik.svg" style="margin-right:10px; align-items: center; display:flex;"  />Pengembalian</a>
        <a <?php if ($thisPage == "Chat") echo "class='active'"; ?> href="chata.php" style="display:flex;"> <img src="img/chat.svg" style="margin-right:10px; align-items: center; display:flex;"  />Chat</a>

        <div class="right">
            <div class="dropdown"> <button class="dropbtn" onclick="myFunction()"> <?=
                                                                                    $user; ?> <i id="icon" class="fa fa-caret-down"></i></button>
                <div class="dropdown-content" id="myDropdown">
                    <a href="logout.php" onclick="return confirm('yakin?');"style="display:flex;"> <img src="img/logout.svg" style="margin-right:10px; align-items: center; display:flex;"  />Logout</a>
                    <a href="pengaturana.php" style="display:flex;"> <img src="img/setting.svg" style="margin-right:10px; align-items: center; display:flex;"  />Pengaturan</a>

                </div>
            </div>
        </div>
    </div>
