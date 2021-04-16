<?php
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
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex flex-wrap align-items-center">
                      <div>
                        <h3 class="card-title">Sales Overview</h3>
                        <h6 class="card-subtitle">Ample Admin Vs Pixel Admin</h6>
                      </div>
                      <div class="ms-lg-auto mx-sm-auto mx-lg-0">
                        <ul class="list-inline d-flex">
                          <li class="me-4">
                            <h6 class="text-success"><i class="fa fa-circle font-10 me-2 "></i>Ample</h6>
                          </li>
                          <li>
                            <h6 class="text-info"><i class="fa fa-circle font-10 me-2"></i>Pixel</h6>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="amp-pxl" style="height: 360px;">
                      <div class="chartist-tooltip"></div>
                    </div>
                  </div>
                </div>
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