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
}else{
    $query="SELECT * FROM tb_barang";
    $res=mysqli_query($conn,$query);
}


?>






    <form action="" method="post">
        <div class="form-group">
            <label for="namabarang">Nama Barang</label>
            <select name="namabarang" id="" class='form-control'>
                <?php
                    while($row=mysqli_fetch_assoc($res)){
                ?>    
                <option value="<?php echo $row['Id_barang']?>"><?php echo $row['Nama_barang'] ?></option>    
                <?php    }
                ?>
            </select>
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
              