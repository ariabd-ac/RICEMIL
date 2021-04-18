<?php
ob_start();
session_start();
include_once "../config/koneksi.php";

if ($_SESSION['level'] != 'supplier') {
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
                <?php
                if (isset($_GET['page'])) {
                  $page = $_GET['page'];
                  // die($page);
                  switch ($page) {
                    case 'profile':
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
                      break;
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