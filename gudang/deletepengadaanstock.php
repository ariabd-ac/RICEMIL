<?php
    session_start();
    include_once "../config/koneksi.php";
    if ($_SESSION['level'] != 'gudang') {
      header("location: 404.php");
    }

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="DELETE FROM tb_pengadaan_stock WHERE Id_barang='$id'";

        $insert=mysqli_query($conn,$query);
        if($insert){
            header('location:/ricemil/gudang/pengadaanstock.php');
        }else{
            die('error '.mysqli_error($conn));
        }
    }

?>