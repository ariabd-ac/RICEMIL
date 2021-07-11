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
                if (isset($_GET['page'])) {
                  $page = $_GET['page'];
                  // die($page);
                  if ($page == "pengadaanstock") {
                    if (isset($_GET['modul'])) {
                      $modul = $_GET['modul'];

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

                          if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $query = "DELETE FROM tb_pengadaan_stock WHERE Id_barang='$id'";

                            $insert = mysqli_query($conn, $query);
                            if ($insert) {
                              header('location:/ricemil/gudang/index.php?page=pengadaanstock');
                            } else {
                              die('error ' . mysqli_error($conn));
                            }
                          }
                          break;
                        default:
                          include 'pengadaanstock/pengadaanstock.php';
                          break;
                      }
                    } else {
                      include 'pengadaanstock/pengadaanstock.php';
                    }
                  } else if ($page == "datastock") {

                    if (isset($_GET['modul'])) {
                      $modul = $_GET['modul'];

                      switch ($modul) {
                        case 'add':
                          include 'datastock/add.php';
                          break;
                        case 'edit':
                          # code...
                          include 'datastock/edit.php';
                          break;
                        case 'delete':
                          # code...

                          if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $query = "DELETE FROM tb_pengadaan_stock WHERE Id_barang='$id'";

                            $insert = mysqli_query($conn, $query);
                            if ($insert) {
                              header('location:/ricemil/gudang/index.php?page=datastock');
                            } else {
                              die('error ' . mysqli_error($conn));
                            }
                          }
                          break;
                        default:
                          include 'datastock/index.php';
                          break;
                      }
                    } else {
                      include 'datastock/index.php';
                    }
                  }else if ($page == "laporanmasuk") {
                    if (isset($_GET['modul'])) {
                      $modul = $_GET['modul'];

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

                          if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $query = "DELETE FROM tb_pengadaan_stock WHERE Id_barang='$id'";

                            $insert = mysqli_query($conn, $query);
                            if ($insert) {
                              header('location:/ricemil/gudang/index.php?page=pengadaanstock');
                            } else {
                              die('error ' . mysqli_error($conn));
                            }
                          }
                          break;
                        default:
                          include 'laporan/laporanmasuk.php';
                          break;
                      }
                    } else {
                      include 'laporan/laporanmasuk.php';
                    }
                  }else if ($page == "laporankeluar") {
                    if (isset($_GET['modul'])) {
                      $modul = $_GET['modul'];

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

                          if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $query = "DELETE FROM tb_pengadaan_stock WHERE Id_barang='$id'";

                            $insert = mysqli_query($conn, $query);
                            if ($insert) {
                              header('location:/ricemil/gudang/index.php?page=pengadaanstock');
                            } else {
                              die('error ' . mysqli_error($conn));
                            }
                          }
                          break;
                        default:
                          include 'pengadaanstock/pengadaanstock.php';
                          break;
                      }
                    } else {
                      include 'pengadaanstock/pengadaanstock.php';
                    }
                  } else if ($page == 'profile') {
                    if (isset($_GET['modul'])) {
                      $modul = $_GET['modul'];
                      switch ($modul) {
                        case 'edit':
                          include 'profile/edit.php';
                          break;
                      }
                    } else {
                      include 'profile/index.php';
                    }
                  }else if ($page == 'transaksi') {
                    if (isset($_GET['modul'])) {
                      $modul = $_GET['modul'];
                      switch ($modul) {
                        case 'detail':
                          include 'transaksi/detail.php';
                          break;
                      }
                    } else {
                      include 'transaksi/index.php';
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