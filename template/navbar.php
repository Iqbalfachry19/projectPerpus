
    <div class="navbar">
    <a   href="#" style="display:flex;"> DIGITAL PERPUS</a>
<a <?php if ($thisPage == "Halaman Admin") echo "class='active'"; ?> href="halaman_admin.php" style="display:flex;">  <img src="img/home.svg" style="margin-right:10px; align-items: center; display:flex;"  />Beranda</a>
<a <?php if ($thisPage == "Daftar Anggota") echo "class='active'"; ?> href="daftar-anggota.php"style="display:flex;"> <img src="img/orang.svg" style="margin-right:10px; align-items: center; display:flex;"  />Daftar Anggota</a>
<a <?php if ($thisPage == "Daftar Buku") echo "class='active'"; ?>href="daftar-buku.php"style="display:flex;"> <img src="img/book.svg" style="margin-right:10px; align-items: center; display:flex;"  />Daftar Buku</a>
<a <?php if ($thisPage == "Peminjaman") echo "class='active'"; ?> href="peminjaman.php"style="display:flex;"> <img src="img/pinjam.svg" style="margin-right:10px; align-items: center; display:flex;"  />Peminjaman</a>
<a <?php if ($thisPage == "Pengembalian") echo "class='active'"; ?> href="pengembalian.php"style="display:flex;"> <img src="img/balik.svg" style="margin-right:10px; align-items: center; display:flex;"  />Pengembalian</a>
<a <?php if ($thisPage == "Laporan") echo "class='active'"; ?> href="laporan.php" style="display:flex;"> <img src="img/laporan.svg" style="margin-right:10px; align-items: center; display:flex;"  />Laporan</a>
<a <?php if ($thisPage == "Chat") echo "class='active'"; ?> href="chat.php"style="display:flex;"> <img src="img/chat.svg" style="margin-right:10px; align-items: center; display:flex;"  />Chat</a>
<div class="right">
    <div class="dropdown"> <button class="dropbtn" onclick="myFunction()"> <?=
                                                                            $user; ?> <i id="icon" class="fa fa-caret-down"></i></button>
        <div class="dropdown-content" id="myDropdown">
            <a href="logout.php" onclick="return confirm('yakin?');" style="display:flex;"> <img src="img/logout.svg" style="margin-right:10px; align-items: center; display:flex;"  />Logout</a>
            <a href="pengaturan.php"style="display:flex;"> <img src="img/setting.svg" style="margin-right:10px; align-items: center; display:flex;"  />Pengaturan</a>

        </div>
    </div>
</div>


</div>