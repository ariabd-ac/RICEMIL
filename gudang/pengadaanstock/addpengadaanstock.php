<?php

if(isset($_POST['submit'])){
    $namaBarang=$_POST['namabarang'];
    $harga=$_POST['harga'];
    $jumlah=$_POST['jumlah'];

    $query="INSERT INTO tb_pengadaan_stock (Nama_barang,Harga,Jumlah) VALUES ('$namaBarang','$harga','$jumlah')";

    $insert=mysqli_query($conn,$query);
    if($insert){
        header('Location:/ricemil/gudang/index.php?page=pengadaanstock');
    }else{
        die('error '.mysqli_error($conn));
    }  
}


?>






    <form action="" method="post">
        <div class="form-group">
            <label for="namabarang">Nama Barang</label>
            <input type="text" name='namabarang' class='form-control'>
        </div>
        <div class="form-group">
            <label for="namabarang">Jumlah</label>
            <input type="text" name='jumlah' class='form-control'>
        </div>
        <div class="form-group">
            <label for="namabarang">Harga</label>
            <input type="text" name='harga' class='form-control'>
        </div>
        <div class="form-group">
            <input type="submit" class='btn btn-success' name='submit' value='submit' class='form-control'>
        </div>
        <!-- <div class="form-group">
            <label for="namabarang">Nama Barang</label>
            <input type="text" name='namabarang' class='form-control'>
        </div> -->
        
    </form>
              