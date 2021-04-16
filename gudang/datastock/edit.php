<?php


if(isset($_GET['id'])){
  $id=$_GET['id'];
}

if(isset($_POST['submit'])){
    $namaBarang=$_POST['namabarang'];
    $harga=$_POST['harga'];
    $jumlah=$_POST['jumlah'];

    $query="UPDATE tb_pengadaan_stock SET Harga='$harga',Jumlah='$jumlah' WHERE Id_barang='$id'";

    $insert=mysqli_query($conn,$query);
    if($insert){
        header('location:/ricemil/gudang/index.php?page=pengadaanstock');
    }else{
        die('error '.mysqli_error($conn));
    }
    
}else{
  
  $query="SELECT tp.*,tb.Nama_barang AS namaBarang FROM tb_pengadaan_stock tp LEFT JOIN tb_barang tb ON tb.Id_barang=tp.Nama_barang WHERE tp.Id_barang=$id";

  $insert=mysqli_query($conn,$query);
  if($insert){

      $hasil=mysqli_fetch_assoc($insert);
      $namaBarang=$hasil['namaBarang'];
      $harga=$hasil['Harga'];
      $jumlah=$hasil['Jumlah'];
      $total=$harga * $jumlah;
  }else{
      die('error '.mysqli_error($conn));
  }
}
?>





              
                <form action="" method="post">
                    <div class="form-group">
                        <!-- <label for="namabarang">Kode Barang</label> -->
                        <!-- <input type="text" name='Id_Barang' class='form-control' value="<?php echo $idBarang?>" > -->
                    </div>
                    <div class="form-group">
                        <label for="namabarang">Nama Barang</label>
                        <input type="text" name='namabarang' class='form-control' value="<?php echo $namaBarang?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="namabarang">Jumlah</label>
                        <input type="text" name='jumlah' class='form-control' value="<?php echo $jumlah?>">
                    </div>
                    <div class="form-group">
                        <label for="namabarang">Harga</label>
                        <input type="text" name='harga' class='form-control' value="<?php echo $harga?>">
                    </div>
                    <div class="form-group">
                        <label for="namabarang">Total</label>
                        <input type="text" name='harga' class='form-control' value="<?php echo $total?>" disabled>
                    </div>
                    <div class="form-group">
                        <input type="submit" class='btn btn-success' name='submit' value='submit' class='form-control'>
                    </div>
                    <!-- <div class="form-group">
                        <label for="namabarang">Nama Barang</label>
                        <input type="text" name='namabarang' class='form-control'>
                    </div> -->
                    
                </form>