<?php
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
              <a class='btn btn-success' href='/ricemil/gudang/addpengadaanstock.php'>Tambah</a>
                <table class="table user-table">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Nama Barang</th>
                            <th class="border-top-0">Jumlah </th>
                            <th class="border-top-0">Harga</th>
                            <th class="border-top-0">Total</th>
                            <th class="border-top-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query="SELECT * FROM tb_pengadaan_stock";
                            $result=mysqli_query($conn,$query);
                            
                            while($row=mysqli_fetch_assoc($result)){
                                ?>
                                <tr>
                                
                                    <td><?php echo $row['Id_barang']?></td>
                                    <td><?php echo $row['Nama_barang']?></td>
                                    <td><?php echo $row['Jumlah']?></td>
                                    <td><?php echo $row['Harga']?></td>
                                    <td><?php echo ($row['Harga'] * $row['Jumlah']) ?></td>
                                    <td>
                                        <a class='btn btn-info' href="/ricemil/gudang/editpengadaanstock.php?id=<?php echo $row['Id_barang'];?>">Edit</a>
                                        <a class='btn btn-danger' href="/ricemil/gudang/deletepengadaanstock.php?id=<?php echo $row['Id_barang'];?>">Delete</a>
                                        
                                    </td>
                                </tr>
                        <?php    
                            }
                        ?>
                    </tbody>
                </table>
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