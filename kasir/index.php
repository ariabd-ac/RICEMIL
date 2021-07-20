<?php
ob_start();
session_start();
include_once "../config/koneksi.php";

// if ($_SESSION['level'] != 'kasir') {
//   header("location: 404.php");
// }
?>

<?php
if (isset($_POST['save'])) {

  $subTotalDetail = $_POST['subTotalDetail'];
  $diskon = $_POST['diskon'];
  $total = $_POST['total'];
  $listData = $_POST['itemList'];
  $user = $_SESSION['unique_id'];
  $response;
  $date     = date("Y/m/d h:i:s");


  $queryInser = "INSERT INTO tb_transaksi(Tanggal_transaksi,subtotal,diskon,status) VALUES ('$date','$subTotalDetail','$diskon','4')";
  // $queryInser = "INSERT INTO tb_transaksi(Id_pelanggan,Tanggal_transaksi,subtotal,diskon,status) VALUES ('$user','$date','$subTotalDetail','$diskon','4')";
  $insert = mysqli_query($conn, $queryInser);
  if ($insert) {
    $idTrx = mysqli_insert_id($conn);
    for ($i = 0; $i < count($listData); $i++) {
      $idItem = $listData[$i]['idBarang'];
      $harga = $listData[$i]['hargaBarang'] / 25;
      // $nama = $listData[$i]['namaBarang'];
      $qty = $listData[$i]['qty'];

      //update stock
      $s="UPDATE tb_barang SET stock=(stock - $qty) WHERE Id_barang = '$idItem'";
      $execS=mysqli_query($conn,$s);
      if(!$execS){
         die('err'.mysqli_error($conn));
      }
      // end update stock
      $insertDetail = "INSERT INTO tb_transaksi_detail(id_transaksi,id_item,harga,qty) VALUES ('$idTrx','$idItem','$harga','$qty')";
      $insertDetailExec = mysqli_query($conn, $insertDetail);
      // ==================================================================
      if ($insertDetailExec) {
        $response = array(
          "status" => "OK",
          "idTrx" => $idTrx
        );
      } else {
        $response = array(
          "status" => "Fail",
          "idTrx" => $idTrx
        );
      }

     
    }
  } else {
    $response = array(
      "status" => "Fail",
      "idTrx" => $idTrx
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
  <!-- <?php
        include './_partials/preloader.php';
        ?> -->
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
            <?php
            if (isset($_GET['page'])) {
              $page = $_GET['page'];
              // die($page);
              switch ($page) {
                case 'kasir':
                  if (isset($_GET['modul'])) {
                    $modul=$_GET['modul'];
                    switch ($modul) {
                      case 'historytransaksi':
                        include 'transaksi/history.php';
                        break;
                      case 'historytransaksidetail':
                        include 'transaksi/historydetail.php';
                        break;
                      default:
                        include 'transaksi/index.php';
                        break;
                    }
                  } else {
                    include 'transaksi/index.php';
                  }
                  break;
                case 'profile':
                  if (isset($_GET['modul'])) {
                    $modul = $_GET['modul'];
                    switch ($modul) {
                      case 'edit':
                        include 'profile/edit.php';
                        break;
                      case 'changepwd':
                        include 'profile/changepwd.php';
                        break;
                    }
                  } else {
                    include 'profile/index.php';
                  }
                  break;
                case 'generatestruck':
                  include '../generatepdf/index.php';
                  break;
                default:

                  break;
              }
            }else{
              include 'transaksi/index.php';
            }
            ?>
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