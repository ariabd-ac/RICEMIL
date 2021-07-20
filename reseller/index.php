<?php
ob_start();
session_start();
include_once "../config/koneksi.php";
if ($_SESSION['level'] != 'reseller') {
  header("location: 404.php");
}
if(isset($_POST['save'])){
  $subTotalDetail = $_POST['subTotalDetail'];
  $total = $_POST['total'];
  $diskon = $_POST['diskon'];
  $listData = $_POST['itemList'];
  $user = $_SESSION['unique_id'];
  $metodeBayar= $_POST['metodeBayar'];;
  $response;
  $queryInser = "INSERT INTO tb_order_masuk(diskon,subtotal,total,metode_bayar,order_by) VALUES ('$diskon','$subTotalDetail','$total','$metodeBayar','$user')";
    $insert = mysqli_query($conn, $queryInser);
    if ($insert) {
      $idTrx=mysqli_insert_id($conn);
      for ($i=0; $i < count($listData) ;$i++) { 
        $idItem=$listData[$i]['idItem'];
        $harga=$listData[$i]['hargaItem'];
        $qty=$listData[$i]['itemQty'];
        $insertDetail="INSERT INTO tb_order_masuk_detail(id_order_masuk,id_item,harga,qty) VALUES ('$idTrx','$idItem','$harga','$qty')";
        $insertDetailExec = mysqli_query($conn, $insertDetail);
        if($insertDetailExec){
          $qtyKarung=$qty*25;
          $updateQuey = "UPDATE tb_barang tb SET tb.stock=(tb.stock - $qtyKarung) WHERE tb.Id_barang='$idItem'";
          $updateExec = mysqli_query($conn, $updateQuey);
          if($updateExec){
            $response=array(
              "status"=>"OK",
              "idTrx"=>$idTrx
            );
          }else{
            $response=array(
              "status"=>"Fail",
              "idTrx"=>$idTrx
            );
          }
        }
      }
    } else {
      $response=array(
        "status"=>"Fail",
        "idTrx"=>$idTrx
      );
    }
  
  echo json_encode($response);
  die;
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
        
        if (isset($_GET['page'])) {
          $page = $_GET['page'];
          // die($page);
          if ($page == "barang") {
            if (isset($_GET['modul'])) {
              $modul = $_GET['modul'];
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
            } else {
              include 'barang/index.php';
            }
          } elseif ($page == "riwayatbelanja") {
            include 'riwayatbelanja/riwayatorder.php';
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
          }
        } else {
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