<?php
    

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="DELETE FROM tb_pengadaan_stock WHERE Id_barang='$id'";

        $insert=mysqli_query($conn,$query);
        if($insert){
            header('location:/ricemil/gudang/index.php?page=pengadaanstock');
        }else{
            die('error '.mysqli_error($conn));
        }
    }

?>