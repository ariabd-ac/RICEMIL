<?php
ob_start();
session_start();
include_once "../config/koneksi.php";
if ($_SESSION['level'] != 'admin') {
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
                  switch ($page) {
                    case 'databarang':
                      if (isset($_GET['modul'])) {
                        $modul = $_GET['modul'];
                        switch ($modul) {
                          case 'add':
                            include 'databarang/add.php';
                            break;
                          case 'edit':
                            include 'databarang/edit.php';
                            break;
                          case 'delete':
                            if (isset($_GET['id'])) {
                              $id = $_GET['id'];
                              $query = "DELETE FROM tb_barang WHERE Id_barang='$id'";

                              $insert = mysqli_query($conn, $query);
                              if ($insert) {
                                header('location:/ricemil/admin/index.php?page=databarang');
                              } else {
                                die('error ' . mysqli_error($conn));
                              }
                            }
                            break;

                          default:
                            include 'databarang/index.php';
                            break;
                        }
                      } else {
                        include 'databarang/index.php';
                      }
                      break;

                    case 'account':
                      if (isset($_GET['modul'])) {
                        $modul  = $_GET['modul'];
                        switch ($modul) {
                          case 'add':
                            include 'management/add.php';
                            break;
                          case 'edit':
                            include 'management/edit.php';
                            break;
                          case 'delete':
                            if (isset($_GET['user_id'])) {
                              $id = $_GET['user_id'];
                              $query = "DELETE FROM users WHERE user_id = '$id'";

                              $insert = mysqli_query($conn, $query);
                              if ($insert) {
                                header('location:/ricemil/admin/index.php?page=account');
                              } else {
                                die('error ' . mysqli_error($conn));
                              }
                            }
                            break;
                          default:
                            include 'management/index.php';
                            break;
                        }
                      } else {
                        include 'management/index.php';
                      }

                    default:

                      break;
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