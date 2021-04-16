<?php

if(isset($_POST['submit'])){
    $namaBarang=$_POST['namabarang'];


    $query="INSERT INTO tb_barang (Nama_barang) VALUES ('$namaBarang')";

    $insert=mysqli_query($conn,$query);
    if($insert){
        header('Location:/ricemil/admin/index.php?page=databarang');
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
            <input type="submit" class='btn btn-success' name='submit' value='submit' class='form-control'>
        </div>
        <!-- <div class="form-group">
            <label for="namabarang">Nama Barang</label>
            <input type="text" name='namabarang' class='form-control'>
        </div> -->
        
    </form>
              