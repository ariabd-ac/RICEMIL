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
                            <th class="border-top-0">Email</th>
                            <th class="border-top-0">Level</th>
                            <th class="border-top-0">Options</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          $q = "SELECT * FROM users ";
                          $results = mysqli_query($conn, $q);
                          var_dump($results);
                          // die;
                          foreach ($results as $res) { ?>
                            <tr>
                              <td><?= $no++ ?></td>
                              <td><?= $res['fname'] ?></td>
                              <td><?= $res['lname'] ?></td>
                              <td><?= $res['username'] ?></td>
                              <td><?= $res['email'] ?></td>
                              <td><?= $res['level'] ?></td>
                              <td> <a href="pakar.php?a=edit-gejala&kode=<?= $res['user_id'] ?>" class="btn btn-primary btn-round btn-sm">Edit</a>
                                <hr>
                                <a href="pakar.php?a=del-gejala&kode=<?= $res['user_id'] ?>" class="btn btn-danger btn-round btn-sm">Del</a>
                              </td>
                            </tr>
                          <?php } ?>
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