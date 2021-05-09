<?php
$conn = mysqli_connect("localhost", "root", "", "project_perpus");
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    $nrp = htmlspecialchars($data["nrp"]);
    $nama =  htmlspecialchars($data["nama"]);
    $email =  htmlspecialchars($data["email"]);
    $jurusan =  htmlspecialchars($data["jurusan"]);

    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "insert into mahasiswa values('','$nrp','$nama','$email','$jurusan','$gambar')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function upload()
{
    $namaFile = $_FILES['sampul']['name'];
    $ukuranFile = $_FILES['sampul']['size'];
    $error = $_FILES['sampul']['error'];
    $tmpName = $_FILES['sampul']['tmp_name'];
    if ($error === 4) {
        echo "<t>
alert('pilih gambar terlebih dahulu');
    </t>";
        return false;
    }
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<t>
        alert('yang anda upload bukan gambar');
            </t>";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "<t>
    alert('ukuran gambar terlalu besar');
        </t>";
        return false;
    }
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}


function cancelp($id)
{
    global $conn;
    mysqli_query($conn, "delete from pinjam where kode_pinjam = $id && kt='pending'");
    return mysqli_affected_rows($conn);
}
function cancelb($id)
{
    global $conn;
    mysqli_query($conn, "delete from kembali where id_kembali = $id && keterangan='pending'");
    return mysqli_affected_rows($conn);
}


function hapus($id)
{
    global $conn;
    mysqli_query($conn, "delete from user where id = $id && level = 'anggota'");
    return mysqli_affected_rows($conn);
}
function hapusbuku($id)
{
    global $conn;
    mysqli_query($conn, "delete from daftar_buku where id = $id");
    return mysqli_affected_rows($conn);
}
function konfirmasi($id)
{
    global $conn;

    $query = "update pinjam set kt = 'sudah konfirmasi' where kode_pinjam = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function konfirmasib($id)
{
    global $conn;
    $query = "update kembali set keterangan = 'sudah konfirmasi' where id_kembali = $id";
    $query1 = "update kembali set keterangan = 'pending' where id_kembali = $id";

    $sql = mysqli_query($conn, $query);
    $sql .= mysqli_query($conn, $query1);
    if (mysqli_multi_query($conn, $sql)) {
        echo 'Data Baru telah ditambahkan';
    }
    return mysqli_affected_rows($conn);
}
function pinjam($id, $user)
{
    global $conn;
    $today = date("Y-m-d");
    $date = strtotime("+7 day");
    $sday = date('Y-m-d', $date);
    $query = "insert into pinjam values('','$user',$id,'$today','$sday',1,'pending')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $nrp = htmlspecialchars($data["judul"]);
    $nama =  htmlspecialchars($data["penerbit"]);
    $email =  htmlspecialchars($data["penulis"]);
    $jumlah =  htmlspecialchars($data["jumlah"]);
    $kategori =  htmlspecialchars($data["kategori"]);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    if ($_FILES['sampul']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "update daftar_buku set judul = '$nrp', penerbit = '$nama', penulis = '$email', sampul = '$gambar', kategori='$kategori', jumlah = $jumlah where id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function ubaha($data)
{
    global $conn;
    $id = $data["id"];
    $nrp = htmlspecialchars($data["judul"]);
    $nama =  htmlspecialchars($data["penulis"]);
    if (empty($data["penerbit"])) {
        $email =   $data["password"];
    } else {
        $email =  md5($data["penerbit"]);
    }

    $query = "update user set nama = '$nrp', password = '$email', username = '$nama' where id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    global $conn;
    $query = "select * from user where level='anggota' and username like '%$keyword%' ";


    return query($query);
}

function carib($keyword)
{
    $query = "select * from daftar_buku where  judul like '%$keyword%' ";
    return query($query);
}

function registrasi($data)
{
    global $conn;
    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);
    $result = mysqli_query($conn, "select username from user where username ='$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('username sudah terdaftar');
        </script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>
        alert('konfirmasi password tidak sesuai');
        </script>
        ";
        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "insert into user values('','$username','$password')");
    return mysqli_affected_rows($conn);
}
