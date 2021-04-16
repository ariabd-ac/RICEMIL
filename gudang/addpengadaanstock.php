<?php
session_start();
include_once "../config/koneksi.php";
if ($_SESSION['level'] != 'gudang') {
  header("location: 404.php");
}

if(isset($_POST['submit'])){
    $namaBarang=$_POST['namabarang'];
    $harga=$_POST['harga'];
    $jumlah=$_POST['jumlah'];

    $query="INSERT INTO tb_pengadaan_stock (Nama_barang,Harga,Jumlah) VALUES ('$namaBarang','$harga','$jumlah')";

    $insert=mysqli_query($conn,$query);
    if($insert){
        header('location:/ricemil/gudang/pengadaanstock.php');
    }else{
        die('error '.mysqli_error($conn));
    }
    
}


?>





<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <?php
  include './_partials/head.php';
  ?>
</head>

<body>
  <?php
  include './_partials/preloader.php';
  ?>
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <?php
    include './_partials/header.php';
    ?>
    <?php
    include './_partials/aside.php';
    ?>
    <div class="page-wrapper">
      <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Sales chart -->
        <!-- ============================================================== -->
        <div class="row">
          <!-- Column -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
              <a class='btn btn-success' href='/ricemil/gudang/addpengadaanstock.php'>Tambah</a>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="namabarang">Nama Barang</label>
                        <input type="text" name='namabarang' class='form-control'>
                    </div>
                    <div class="form-group">
                        <label for="namabarang">Jumlah</label>
                        <input type="text" name='jumlah' class='form-control'>
                    </div>
                    <div class="form-group">
                        <label for="namabarang">Harga</label>
                        <input type="text" name='harga' class='form-control'>
                    </div>
                    <div class="form-group">
                        <input type="submit" class='btn btn-success' name='submit' value='submit' class='form-control'>
                    </div>
                    <!-- <div class="form-group">
                        <label for="namabarang">Nama Barang</label>
                        <input type="text" name='namabarang' class='form-control'>
                    </div> -->
                    
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
      include './_partials/footer.php';
      ?>
    </div>

  </div>
  <?php
  include './_partials/script.php';
  ?>
</body>

</html>