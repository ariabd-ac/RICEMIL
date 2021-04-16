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
                    <h3>Management users</h3>
                    <a href="./add-user.php" class="btn btn-danger d-none d-md-inline-block text-white">Tambah Akun</a>
                  </div>
                  <div class="col-12">
                    <div class="table-responsive">
                      <table class="table user-table">
                        <thead>
                          <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">First Name</th>
                            <th class="border-top-0">Last Name</th>
                            <th class="border-top-0">Username</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Deshmukh</td>
                            <td>Prohaska</td>
                            <td>@Genelia</td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Deshmukh</td>
                            <td>Gaylord</td>
                            <td>@Ritesh</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Sanghani</td>
                            <td>Gusikowski</td>
                            <td>@Govinda</td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Roshan</td>
                            <td>Rogahn</td>
                            <td>@Hritik</td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>Joshi</td>
                            <td>Hickle</td>
                            <td>@Maruti</td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>Nigam</td>
                            <td>Eichmann</td>
                            <td>@Sonu</td>
                          </tr>
                        </tbody>
                      </table>
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