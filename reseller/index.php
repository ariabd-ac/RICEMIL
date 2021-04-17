<?php
ob_start();
session_start();
include_once "../config/koneksi.php";
if ($_SESSION['level'] != 'reseller') {
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
        <?php
                  if(isset($_GET['page'])){
                    $page=$_GET['page'];
                    // die($page);
                    if($page=="barang"){
                      if(isset($_GET['modul'])){
                        $modul=$_GET['modul'];
                        // die($modul);
                        switch ($modul) {
                          case 'detail':
                            include 'barang/detail.php';
                            break;
                          case 'pesan':
                          
                            break;
                          default:
                            
                            break;
                        }
                      }else{
                        include 'barang/index.php';
                      }
                    }elseif($page=="riwayatbelanja"){
                      
                      include 'riwayatbelanja/riwayatorder.php';
                    }
                  }else{
                    include 'barang/index.php';

                  }

                  
                ?>
                
                
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
