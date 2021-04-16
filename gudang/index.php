<?php
ob_start();
session_start();
include_once "../config/koneksi.php";
if ($_SESSION['level'] != 'gudang') {
  header("location: 404.php");
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
  // include './_partials/preloader.php';
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
                <?php
                  if(isset($_GET['page'])){
                    $page=$_GET['page'];
                    if($page="pengadaanstock"){
                      if(isset($_GET['modul'])){
                        $modul=$_GET['modul'];
                        
                        switch ($modul) {
                          case 'add':
                            include 'pengadaanstock/addpengadaanstock.php';
                            break;
                          case 'edit':
                            # code...
                            include 'pengadaanstock/editpengadaanstock.php';
                            break;
                          case 'delete':
                            # code...
                            
                            if(isset($_GET['id'])){
                              $id=$_GET['id'];
                              $query="DELETE FROM tb_pengadaan_stock WHERE Id_barang='$id'";
                      
                              $insert=mysqli_query($conn,$query);
                              if($insert){
                                  header('location:/ricemil/gudang/index.php?page=pengadaanstock');
                              }else{
                                  die('error '.mysqli_error($conn));
                              }
                            }
                            break;
                          default:
                            include 'pengadaanstock/pengadaanstock.php';
                            break;
                        }
                      }else{
                        include 'pengadaanstock/pengadaanstock.php';
                      }
                    }
                  }

                  
                ?>
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