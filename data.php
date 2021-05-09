<table id="customers">
    <thead>
        <tr>
            <th>No</th>
            <th>id pinjam</th>
            <th>id kembali</th>
            <th>username</th>
            <th>id buku</th>
            <th>tanggal pinjam</th>
            <th>tanggal kembali</th>
            <th>denda</th>
            <th>keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'functions.php';
        if (isset($_POST['jurusan'])) {
            if ($_POST['jurusan'] == "") { ?><tr>
                    <td colspan='9'>Tidak ada data ditemukan</td>
                </tr> <?php }
                    if ($_POST['jurusan'] == "a") {
                        $no = 1;
                        $query = "SELECT * FROM laporan ORDER BY id ASC LIMIT 100";
                        $dewan1 = $conn->prepare($query);

                        $dewan1->execute();
                        $res1 = $dewan1->get_result();
                        if ($res1->num_rows > 0) {
                            while ($row = $res1->fetch_assoc()) {
                                $id = $row['id'];
                                $nama_mahasiswa = $row['id_pinjam'];
                                $alamat = $row['id_kembali'];
                                $jurusan = $row['username'];
                                $jenis_kelamin = $row['id_buku'];
                                $tgl_masuk = $row['tanggal_pinjam'];
                                $tgl_kembali = $row['tanggal_kembali'];
                                $denda = $row['denda'];
                                $kt = $row['keterangan'];
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><a href="peminjaman.php?id=<?=
                                                            $row["id_pinjam"]; ?>"><?php echo $nama_mahasiswa; ?></a></td>
                            <td><a href="pengembalian.php?id=<?=
                                                                $row["id_kembali"]; ?>"><?php echo $alamat; ?></a></td>
                            <td><a href="daftar-anggota.php?id=<?=
                                                                $row["username"]; ?>"><?php echo $jurusan; ?></a></td>
                            <td><a href="daftar-buku.php?id=<?=
                                                            $row["id_buku"]; ?>"><?php echo $jenis_kelamin; ?></a></td>
                            <td><?php echo $tgl_masuk; ?></td>
                            <td><?php echo $tgl_kembali; ?></td>
                            <td><?php echo $denda; ?></td>
                            <td><?php echo $kt; ?></td>
                        </tr>
                    <?php }
                        } else { ?> <tr>
                        <td colspan='9'>Tidak ada data ditemukan</td>
                    </tr> <?php
                        }
                    }
                    if ($_POST['jurusan'] == "b") {
                        $no = 1;
                        $query = "SELECT * FROM laporan where DATE(tanggal_pinjam)=DATE(NOW()) OR DATE(tanggal_kembali)=DATE(NOW()) ORDER BY id ASC LIMIT 100";
                        $dewan1 = $conn->prepare($query);

                        $dewan1->execute();
                        $res1 = $dewan1->get_result();
                        if ($res1->num_rows > 0) {
                            while ($row = $res1->fetch_assoc()) {
                                $id = $row['id'];
                                $nama_mahasiswa = $row['id_pinjam'];
                                $alamat = $row['id_kembali'];
                                $jurusan = $row['username'];
                                $jenis_kelamin = $row['id_buku'];
                                $tgl_masuk = $row['tanggal_pinjam'];
                                $tgl_kembali = $row['tanggal_kembali'];
                                $denda = $row['denda'];
                                $kt = $row['keterangan'];
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><a href="peminjaman.php?id=<?=
                                                            $row["id_pinjam"]; ?>"><?php echo $nama_mahasiswa; ?></a></td>
                            <td><a href="pengembalian.php?id=<?=
                                                                $row["id_kembali"]; ?>"><?php echo $alamat; ?></a></td>
                            <td><a href="daftar-anggota.php?id=<?=
                                                                $row["username"]; ?>"><?php echo $jurusan; ?></a></td>
                            <td><a href="daftar-buku.php?id=<?=
                                                            $row["id_buku"]; ?>"><?php echo $jenis_kelamin; ?></a></td>
                            <td><?php echo $tgl_masuk; ?></td>
                            <td><?php echo $tgl_kembali; ?></td>
                            <td><?php echo $denda; ?></td>
                            <td><?php echo $kt; ?></td>
                        </tr>

                    <?php
                            }
                        } else { ?> <tr>
                        <td colspan='9'>Tidak ada data ditemukan</td>
                    </tr> <?php
                        }
                    }
                    if ($_POST['jurusan'] == "c") {
                        $no = 1;
                        $query = "SELECT * FROM laporan where WEEK(tanggal_pinjam)=WEEK(NOW()) OR WEEK(tanggal_kembali)=WEEK(NOW()) ORDER BY id ASC LIMIT 100";
                        $dewan1 = $conn->prepare($query);

                        $dewan1->execute();
                        $res1 = $dewan1->get_result();
                        if ($res1->num_rows > 0) {
                            while ($row = $res1->fetch_assoc()) {
                                $id = $row['id'];
                                $nama_mahasiswa = $row['id_pinjam'];
                                $alamat = $row['id_kembali'];
                                $jurusan = $row['username'];
                                $jenis_kelamin = $row['id_buku'];
                                $tgl_masuk = $row['tanggal_pinjam'];
                                $tgl_kembali = $row['tanggal_kembali'];
                                $denda = $row['denda'];
                                $kt = $row['keterangan'];
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><a href="peminjaman.php?id=<?=
                                                            $row["id_pinjam"]; ?>"><?php echo $nama_mahasiswa; ?></a></td>
                            <td><a href="pengembalian.php?id=<?=
                                                                $row["id_kembali"]; ?>"><?php echo $alamat; ?></a></td>
                            <td><a href="daftar-anggota.php?id=<?=
                                                                $row["username"]; ?>"><?php echo $jurusan; ?></a></td>
                            <td><a href="daftar-buku.php?id=<?=
                                                            $row["id_buku"]; ?>"><?php echo $jenis_kelamin; ?></a></td>
                            <td><?php echo $tgl_masuk; ?></td>
                            <td><?php echo $tgl_kembali; ?></td>
                            <td><?php echo $denda; ?></td>
                            <td><?php echo $kt; ?></td>
                        </tr>

                    <?php
                            }
                        } else { ?> <tr>
                        <td colspan='9'>Tidak ada data ditemukan</td>
                    </tr> <?php
                        }
                    }
                    if ($_POST['jurusan'] == "d") {
                        $no = 1;
                        $query = "SELECT * FROM laporan where  MONTH(tanggal_pinjam)=MONTH(NOW()) OR MONTH(tanggal_kembali)=MONTH(NOW()) ORDER BY id ASC LIMIT 100";
                        $dewan1 = $conn->prepare($query);

                        $dewan1->execute();
                        $res1 = $dewan1->get_result();
                        if ($res1->num_rows > 0) {
                            while ($row = $res1->fetch_assoc()) {
                                $id = $row['id'];
                                $nama_mahasiswa = $row['id_pinjam'];
                                $alamat = $row['id_kembali'];
                                $jurusan = $row['username'];
                                $jenis_kelamin = $row['id_buku'];
                                $tgl_masuk = $row['tanggal_pinjam'];
                                $tgl_kembali = $row['tanggal_kembali'];
                                $denda = $row['denda'];
                                $kt = $row['keterangan'];
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><a href="peminjaman.php?id=<?=
                                                            $row["id_pinjam"]; ?>"><?php echo $nama_mahasiswa; ?></a></td>
                            <td><a href="pengembalian.php?id=<?=
                                                                $row["id_kembali"]; ?>"><?php echo $alamat; ?></a></td>
                            <td><a href="daftar-anggota.php?id=<?=
                                                                $row["username"]; ?>"><?php echo $jurusan; ?></a></td>
                            <td><a href="daftar-buku.php?id=<?=
                                                            $row["id_buku"]; ?>"><?php echo $jenis_kelamin; ?></a></td>
                            <td><?php echo $tgl_masuk; ?></td>
                            <td><?php echo $tgl_kembali; ?></td>
                            <td><?php echo $denda; ?></td>
                            <td><?php echo $kt; ?></td>
                        </tr>

                    <?php
                            }
                        } else { ?> <tr>
                        <td colspan='9'>Tidak ada data ditemukan</td>
                    </tr> <?php
                        }
                    }
                    if ($_POST['jurusan'] == "e") {
                        $no = 1;
                        $query = "SELECT * FROM laporan where YEAR(tanggal_pinjam)=YEAR(NOW()) OR YEAR(tanggal_kembali)=YEAR(NOW()) ORDER BY id ASC LIMIT 100";
                        $dewan1 = $conn->prepare($query);

                        $dewan1->execute();
                        $res1 = $dewan1->get_result();
                        if ($res1->num_rows > 0) {
                            while ($row = $res1->fetch_assoc()) {
                                $id = $row['id'];
                                $nama_mahasiswa = $row['id_pinjam'];
                                $alamat = $row['id_kembali'];
                                $jurusan = $row['username'];
                                $jenis_kelamin = $row['id_buku'];
                                $tgl_masuk = $row['tanggal_pinjam'];
                                $tgl_kembali = $row['tanggal_kembali'];
                                $denda = $row['denda'];
                                $kt = $row['keterangan'];
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><a href="peminjaman.php?id=<?=
                                                            $row["id_pinjam"]; ?>"><?php echo $nama_mahasiswa; ?></a></td>
                            <td><a href="pengembalian.php?id=<?=
                                                                $row["id_kembali"]; ?>"><?php echo $alamat; ?></a></td>
                            <td><a href="daftar-anggota.php?id=<?=
                                                                $row["username"]; ?>"><?php echo $jurusan; ?></a></td>
                            <td><a href="daftar-buku.php?id=<?=
                                                            $row["id_buku"]; ?>"><?php echo $jenis_kelamin; ?></a></td>
                            <td><?php echo $tgl_masuk; ?></td>
                            <td><?php echo $tgl_kembali; ?></td>
                            <td><?php echo $denda; ?></td>
                            <td><?php echo $kt; ?></td>
                        </tr>

                    <?php
                            }
                        } else { ?> <tr>
                        <td colspan='9'>Tidak ada data ditemukan</td>
                    </tr> <?php
                        }
                    }
                    if ($_POST['jurusan'] == "f") {
                        $no = 1;
                        $query = "SELECT * FROM laporan where keterangan ='telat' ORDER BY id ASC LIMIT 100";
                        $dewan1 = $conn->prepare($query);

                        $dewan1->execute();
                        $res1 = $dewan1->get_result();
                        if ($res1->num_rows > 0) {
                            while ($row = $res1->fetch_assoc()) {
                                $id = $row['id'];
                                $nama_mahasiswa = $row['id_pinjam'];
                                $alamat = $row['id_kembali'];
                                $jurusan = $row['username'];
                                $jenis_kelamin = $row['id_buku'];
                                $tgl_masuk = $row['tanggal_pinjam'];
                                $tgl_kembali = $row['tanggal_kembali'];
                                $denda = $row['denda'];
                                $kt = $row['keterangan'];
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><a href="peminjaman.php?id=<?=
                                                            $row["id_pinjam"]; ?>"><?php echo $nama_mahasiswa; ?></a></td>
                            <td><a href="pengembalian.php?id=<?=
                                                                $row["id_kembali"]; ?>"><?php echo $alamat; ?></a></td>
                            <td><a href="daftar-anggota.php?id=<?=
                                                                $row["username"]; ?>"><?php echo $jurusan; ?></a></td>
                            <td><a href="daftar-buku.php?id=<?=
                                                            $row["id_buku"]; ?>"><?php echo $jenis_kelamin; ?></a></td>
                            <td><?php echo $tgl_masuk; ?></td>
                            <td><?php echo $tgl_kembali; ?></td>
                            <td><?php echo $denda; ?></td>
                            <td><?php echo $kt; ?></td>
                        </tr>

                    <?php
                            }
                        } else { ?> <tr>
                        <td colspan='9'>Tidak ada data ditemukan</td>
                    </tr> <?php
                        }
                    }
                    if ($_POST['jurusan'] == "g") {
                        $no = 1;
                        $query = "SELECT * FROM laporan where keterangan ='tidak telat' ORDER BY id ASC LIMIT 100";
                        $dewan1 = $conn->prepare($query);

                        $dewan1->execute();
                        $res1 = $dewan1->get_result();
                        if ($res1->num_rows > 0) {
                            while ($row = $res1->fetch_assoc()) {
                                $id = $row['id'];
                                $nama_mahasiswa = $row['id_pinjam'];
                                $alamat = $row['id_kembali'];
                                $jurusan = $row['username'];
                                $jenis_kelamin = $row['id_buku'];
                                $tgl_masuk = $row['tanggal_pinjam'];
                                $tgl_kembali = $row['tanggal_kembali'];
                                $denda = $row['denda'];
                                $kt = $row['keterangan'];
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><a href="peminjaman.php?id=<?=
                                                            $row["id_pinjam"]; ?>"><?php echo $nama_mahasiswa; ?></a></td>
                            <td><a href="pengembalian.php?id=<?=
                                                                $row["id_kembali"]; ?>"><?php echo $alamat; ?></a></td>
                            <td><a href="daftar-anggota.php?id=<?=
                                                                $row["username"]; ?>"><?php echo $jurusan; ?></a></td>
                            <td><a href="daftar-buku.php?id=<?=
                                                            $row["id_buku"]; ?>"><?php echo $jenis_kelamin; ?></a></td>
                            <td><?php echo $tgl_masuk; ?></td>
                            <td><?php echo $tgl_kembali; ?></td>
                            <td><?php echo $denda; ?></td>
                            <td><?php echo $kt; ?></td>
                        </tr>

                    <?php
                            }
                        } else { ?> <tr>
                        <td colspan='9'>Tidak ada data ditemukan</td>
                    </tr> <?php
                        }
                    }
                    if ($_POST['jurusan'] == "h") {
                        $no = 1;
                        $query = "SELECT * FROM laporan where keterangan ='belum kembali' ORDER BY id ASC LIMIT 100";
                        $dewan1 = $conn->prepare($query);

                        $dewan1->execute();
                        $res1 = $dewan1->get_result();
                        if ($res1->num_rows > 0) {
                            while ($row = $res1->fetch_assoc()) {
                                $id = $row['id'];
                                $nama_mahasiswa = $row['id_pinjam'];
                                $alamat = $row['id_kembali'];
                                $jurusan = $row['username'];
                                $jenis_kelamin = $row['id_buku'];
                                $tgl_masuk = $row['tanggal_pinjam'];
                                $tgl_kembali = $row['tanggal_kembali'];
                                $denda = $row['denda'];
                                $kt = $row['keterangan'];
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><a href="peminjaman.php?id=<?=
                                                            $row["id_pinjam"]; ?>"><?php echo $nama_mahasiswa; ?></a></td>
                            <td><a href="pengembalian.php?id=<?=
                                                                $row["id_kembali"]; ?>"><?php echo $alamat; ?></a></td>
                            <td><a href="daftar-anggota.php?id=<?=
                                                                $row["username"]; ?>"><?php echo $jurusan; ?></a></td>
                            <td><a href="daftar-buku.php?id=<?=
                                                            $row["id_buku"]; ?>"><?php echo $jenis_kelamin; ?></a></td>
                            <td><?php echo $tgl_masuk; ?></td>
                            <td><?php echo $tgl_kembali; ?></td>
                            <td><?php echo $denda; ?></td>
                            <td><?php echo $kt; ?></td>
                        </tr>

                    <?php
                            }
                        } else { ?> <tr>
                        <td colspan='9'>Tidak ada data ditemukan</td>
                    </tr> <?php
                        }
                    }
                } else { ?> <tr>
                <td colspan='9'>Tidak ada data ditemukan</td>
            </tr> <?php
                }
                    ?>

    </tbody>
</table>