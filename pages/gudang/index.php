<?php
session_start();
// include_once "../config/koneksi.php";
if ($_SESSION['level'] != 'reseller') {
  // if (empty($_SESSION['unique_id']) && empty($_SESSION['gudang']) || empty($_SESSION['level'])) {
  //   header("location: 404.php");
  // }
  header("location: 404.php");
  // if (isset($_SESSION['unique_id'])) {
  //   header("location: 404.php");
  // }
}
?>





<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <?php
  include 'pages/gudang/_partials/head.php';
  ?>
</head>

<body>
  <?php
  include 'pages/gudang/_partials/preloader.php';
  ?>
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <?php
    include 'pages/gudang/_partials/header.php';
    ?>
    <?php
    include 'pages/gudang/_partials/aside.php';
    ?>
    <div class="page-wrapper">
      <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Sales chart -->
        <!-- ============================================================== -->
        <?php 
        // die($fungsi);
        include 'pages/gudang/components/'.$fungsi.'.php' ;?>
      </div>
      <?php
      include 'pages/gudang/_partials/footer.php';
      ?>
    </div>

  </div>
  <?php
  include 'pages/gudang/_partials/script.php';
  ?>
</body>

</html>