<?php
session_start();
require "functions.php";
$thisPage = "Daftar Anggota";


if (!isset($_SESSION['username'])) {
    header("Location:index.php");
    exit;
}
if (isset($_SESSION['level'])) {
    // jika level admin
    if ($_SESSION['level'] == "admin") {
    }
    // jika kondisi level user maka akan diarahkan ke halaman lain
    else if ($_SESSION['level'] == "anggota") {
        header('location:halaman_anggota.php');
    }
}
$page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
   
$kolomCari=(isset($_GET['Kolom']))? $_GET['Kolom'] : "";
$kolomId=(isset($_GET['id']))? $_GET['id'] : "";

$kolomKataKunci=(isset($_GET['KataKunci']))? $_GET['KataKunci'] : "";
$limit = 2;
    
$limitStart = ($page - 1) * $limit;
$no = $limitStart + 1;
$user = $_SESSION['username'];
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Getting parameter value inside PHP variable
    
     $SqlQuery = mysqli_query($conn,"select * from user where level='anggota' && username ='$id' LIMIT " .$limitStart.",".$limit);
} else {


    
    // Jumlah data per halaman

    
    if($kolomCari=="" && $kolomKataKunci==""){
        $SqlQuery = mysqli_query($conn, "SELECT * FROM user WHERE level='anggota' LIMIT ".$limitStart.",".$limit);
      }else{
        //kondisi jika parameter kolom pencarian diisi
        $SqlQuery = mysqli_query($conn, "SELECT * FROM user WHERE level='anggota' and $kolomCari LIKE '%$kolomKataKunci%' LIMIT ".$limitStart.",".$limit);
      }
    
   

}





?>
<!DOCTYPE html>
<html>

<head>
<noscript><meta http-equiv="refresh" content="0; url=script-disable.php"/></noscript>
    <title><?php echo $thisPage; ?></title>
    <link rel="stylesheet" href="style_ada.css">
    <link rel="stylesheet" href="style_tab.css">
    <link rel="icon" href="favicon.ico" type="image/ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    <p>disini anda bisa melihat semua daftar anggota</p>
   
<!-- pencarian -->
    <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading"><b>Pencarian</b></div>
        <div class="panel-body">
          <form class="form-inline" >
            <div class="form-group">
              <select class="form-control" id="Kolom" name="Kolom" required="">
                <?php
                  $kolom=(isset($_GET['Kolom']))? $_GET['Kolom'] : "";
                ?>
                <option value="Nama" <?php if ($kolom=="Nama") echo "selected"; ?>>Nama</>
                <option value="Username" <?php if ($kolom=="Username") echo "selected";?>>Username</option>
                <option value="Password" <?php if ($kolom=="Password") echo "selected";?>>Password</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="KataKunci" name="KataKunci" placeholder="Kata kunci.." required="" value="<?php if (isset($_GET['KataKunci']))  echo $_GET['KataKunci']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="daftar-anggota.php" class="btn btn-danger">Reset</a>
          </form>
        </div>
      </div>
    </div>
  </div>

    <table id="customers">

        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Password</th>
            <th class="aksi">Aksi</th>
        </tr>
        <?php

        ?>
        <?php
        foreach ($SqlQuery as $row) :
        ?>
            <tr>
                <td><?=
                    $no++; ?></td>
                <td><?=
                    $row["nama"]; ?></td>
                <td><?=
                    $row["username"]; ?></td>
                <td><?=
                    $row["password"]; ?></td>

                <td class="aksi">
                    <a style="text-decoration: none;" class="btn btn-warning" href="ubah.php?id=<?= $row["id"]; ?>">ubah</a>
                    <a style="text-decoration: none;" class="btn btn-danger" href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
                </td>
            </tr>
            <?php
          
            ?>
            <?php
        endforeach;
            ?><?php if (isset($_GET["KataKunci"])) {
                    if (mysqli_num_rows( $SqlQuery) == 0) {
                        $error = "no data";
                ?></tr>
            <td colspan='9'><?=
                            $error; ?></td>
            </tr>
            
        <?php } else {
                     ?></table>

                     <div align="right" style="margin-bottom: 100px;">
                   <ul class="pagination justify-content-center " >
                     <?php
                       // Jika page = 1, maka LinkPrev disable
                       if($page == 1){ 
                     ?>        
                       <!-- link Previous Page disable --> 
                       <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                     <?php
                       }
                       else{ 
                         $LinkPrev = ($page > 1)? $page - 1 : 1;  
                 
                         if($kolomCari=="" && $kolomKataKunci==""){
                         ?>
                           <li class="page-item"><a class="page-link" href="daftar-anggota.php?page=<?php echo $LinkPrev; ?>">Previous</a></li>
                      <?php     
                         }else{
                       ?> 
                         <li class="page-item"><a class="page-link" href="daftar-anggota.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $LinkPrev;?>">Previous</a></li>
                        <?php
                          } 
                       }
                     ?>
                 
                     <?php
                    if (isset($_GET['id'])) {
                     $id = $_GET['id']; // Getting parameter value inside PHP variable
                     
                      $SqlQuery = mysqli_query($conn,"select * from user where level='anggota' && username ='$id' LIMIT " .$limitStart.",".$limit);
                 } else {
                 
                 
                     
                     // Jumlah data per halaman
                 
                     
                     if($kolomCari=="" && $kolomKataKunci==""){
                         $SqlQuery = mysqli_query($conn, "SELECT * FROM user WHERE level='anggota'");
                       }else{
                         //kondisi jika parameter kolom pencarian diisi
                         $SqlQuery = mysqli_query($conn, "SELECT * FROM user WHERE level='anggota' and $kolomCari LIKE '%$kolomKataKunci%' ");
                       }
                     
                    
                 
                 }
                     
                       //Hitung semua jumlah data yang berada pada tabel Sisawa
                       $JumlahData = mysqli_num_rows($SqlQuery);
                       
                       // Hitung jumlah halaman yang tersedia
                       $jumlahPage = ceil($JumlahData / $limit); 
                       
                       // Jumlah link number 
                       $jumlahNumber = 1; 
                 
                       // Untuk awal link number
                       $startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1; 
                       
                       // Untuk akhir link number
                       $endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage; 
                       
                       for($i = $startNumber; $i <= $endNumber; $i++){
                         $linkActive = ($page == $i)? ' class="active page-item"' : '';
                 
                         if($kolomCari=="" && $kolomKataKunci==""){
                     ?>
                         <li<?php echo $linkActive; ?>><a class="page-link" href="daftar-anggota.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                 
                     <?php
                       }else{
                         ?>
                         <li<?php echo $linkActive; ?>><a class="page-link" href="daftar-anggota.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                         <?php
                       }
                     }
                     ?>
                     
                     <!-- link Next Page -->
                     <?php       
                      if($page == $jumlahPage){ 
                     ?>
                       <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                     <?php
                     }
                     else{
                       $linkNext = ($page < $jumlahPage)? $page + 1 : $jumlahPage;
                      if($kolomCari=="" && $kolomKataKunci==""){
                         ?>
                           <li class="page-item"><a class="page-link" href="daftar-anggota.php?page=<?php echo $linkNext; ?>">Next</a></li>
                      <?php     
                         }else{
                       ?> 
                          <li class="page-item"><a class="page-link" href="daftar-anggota.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $linkNext; ?>">Next</a></li>
                     <?php
                       }
                     }
                     ?>
                   </ul>
                 </div>
    <?php }
                }  if (!isset($_GET["KataKunci"])) {  ?>
    </table>

    <div align="right" style="margin-bottom: 100px;">
  <ul class="pagination justify-content-center " >
    <?php
      // Jika page = 1, maka LinkPrev disable
      if($page == 1){ 
    ?>        
      <!-- link Previous Page disable --> 
      <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
    <?php
      }
      else{ 
        $LinkPrev = ($page > 1)? $page - 1 : 1;  

        if($kolomCari=="" && $kolomKataKunci==""){
        ?>
          <li class="page-item"><a class="page-link" href="daftar-anggota.php?page=<?php echo $LinkPrev; ?>">Previous</a></li>
     <?php     
        }else{
      ?> 
        <li class="page-item"><a class="page-link" href="daftar-anggota.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $LinkPrev;?>">Previous</a></li>
       <?php
         } 
      }
    ?>

    <?php
   if (isset($_GET['id'])) {
    $id = $_GET['id']; // Getting parameter value inside PHP variable
    
     $SqlQuery = mysqli_query($conn,"select * from user where level='anggota' && username ='$id' LIMIT " .$limitStart.",".$limit);
} else {


    
    // Jumlah data per halaman

    
    if($kolomCari=="" && $kolomKataKunci==""){
        $SqlQuery = mysqli_query($conn, "SELECT * FROM user WHERE level='anggota'");
      }else{
        //kondisi jika parameter kolom pencarian diisi
        $SqlQuery = mysqli_query($conn, "SELECT * FROM user WHERE level='anggota' and $kolomCari LIKE '%$kolomKataKunci%' ");
      }
    
   

}
    
      //Hitung semua jumlah data yang berada pada tabel Sisawa
      $JumlahData = mysqli_num_rows($SqlQuery);
      
      // Hitung jumlah halaman yang tersedia
      $jumlahPage = ceil($JumlahData / $limit); 
      
      // Jumlah link number 
      $jumlahNumber = 1; 

      // Untuk awal link number
      $startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1; 
      
      // Untuk akhir link number
      $endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage; 
      
      for($i = $startNumber; $i <= $endNumber; $i++){
        $linkActive = ($page == $i)? ' class="active page-item"' : '';

        if(isset($_GET['id'])){if($kolomId==$id){
          ?>
          <li<?php echo $linkActive; ?>><a class="page-link" href="daftar-anggota.php?id=<?php echo $id; ?>"><?php echo $i; ?></a></li>
        
        <?php
        } if($kolomCari=="" && $kolomKataKunci==""&& $kolomId==""){
          ?>
              <li<?php echo $linkActive; ?>><a class="page-link" href="daftar-anggota.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          
          <?php
            }}
       else{
        ?>
        <li<?php echo $linkActive; ?>><a class="page-link" href="daftar-anggota.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php
      }
    }
    ?>
    
    <!-- link Next Page -->
    <?php       
     if($page == $jumlahPage){ 
    ?>
      <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
    <?php
    }
    else{
      $linkNext = ($page < $jumlahPage)? $page + 1 : $jumlahPage;
     if($kolomCari=="" && $kolomKataKunci==""){
        ?>
          <li class="page-item"><a class="page-link" href="daftar-anggota.php?page=<?php echo $linkNext; ?>">Next</a></li>
     <?php     
        }else{
      ?> 
         <li class="page-item"><a class="page-link" href="daftar-anggota.php?Kolom=<?php echo $kolomCari;?>&KataKunci=<?php echo $kolomKataKunci;?>&page=<?php echo $linkNext; ?>">Next</a></li>
    <?php
      }
    }
    ?>
  </ul>
</div>
<?php } ?>
<?php include 'template/footer.php'; ?>

    <script src="script.js">

    </script>



</body>

</html>