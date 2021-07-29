<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}



if (isset($_POST['submit'])) {
    // $namaBarang = $_POST['namabarang'];
    // $harga = $_POST['harga'];
    // $jumlah = $_POST['jumlah'];
    $succesUpload = false;

    // $gambar = $_FILES['gambar'];
    $root = realpath(dirname(__FILE__));
    $hargaBeli=$_POST['hargasupplier'];
    
    // if ($gambar['name']) {
    //     $targetDir =  $_SERVER["DOCUMENT_ROOT"] . '/ricemil/assets/images/produk/';

    //     $targetFile = $targetDir . basename($gambar['name']);
    //     $asal = $gambar['tmp_name'];

    //     if (move_uploaded_file($asal, $targetFile)) {
    //         $succesUpload = true;
    //     } else {
    //         die('error Gambar');
    //     }
    // }
    // $query = "UPDATE tb_barang SET Nama_barang='$namaBarang',harga='$harga' WHERE Id_barang='$id'";

    $querySelect="SELECT id_item,id_supplier FROM tb_harga_supplier WHERE id_item='$_GET[id]' AND id_supplier='$_SESSION[unique_id]'";
    
    $exec=mysqli_query($conn,$querySelect);
    if(!$exec){
        die(mysqli_error($conn));
    }
    $queryToDo="INSERT INTO tb_harga_supplier (id_item,id_supplier,harga) VALUE ('$_GET[id]','$_SESSION[unique_id]','$hargaBeli')";
    if(mysqli_num_rows($exec) > 0){   
        $queryToDo="UPDATE tb_harga_supplier SET harga='$hargaBeli' WHERE id_item='$_GET[id]' AND id_supplier='$_SESSION[unique_id]'";
    }
    $execAct=mysqli_query($conn,$queryToDo);
    
    if(!$execAct){
        die("ERROR ==>".mysqli_error($conn));
    }else{
        header('location:/ricemil/supplier/index.php?page=databarang');
    }
    
} else {

    $query = "SELECT 
    tb_barang.Id_barang,tb_barang.harga,tb_barang.gambar,tb_barang.Nama_barang,
    tb_harga_supplier.harga AS hargaSupplier
    FROM tb_barang
    LEFT JOIN tb_harga_supplier ON tb_harga_supplier.id_item=tb_barang.Id_barang AND tb_harga_supplier.id_supplier=$_SESSION[unique_id]
    WHERE tb_barang.Id_barang=$id";

    $insert = mysqli_query($conn, $query);
    if ($insert) {
        $hasil = mysqli_fetch_assoc($insert);
        // die(var_dump($hasil));
        $kodebarang = $hasil['Id_barang'];
        $namaBarang = $hasil['Nama_barang'];
        $harga = $hasil['harga'];
        $hargaSupplier = $hasil['hargaSupplier'];
        $gambarFile=$hasil['gambar'];
    } else {
        die('error ' . mysqli_error($conn));
    }
}
?>





<div class="card">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div style='display:flex;justify-content:center;align-items:center;'>
                <img src="http://localhost/ricemil/assets/images/produk/<?php echo $gambarFile ?>" alt="" height="300px" width="300px">
            </div>
            <div class="form-group">
                <label for="namabarang">Kode Barang</label>
                <input type="text" name='koedbarang' class='form-control' value="<?php echo $kodebarang ?>" disabled>
            </div>
            <div class="form-group">
                <label for="namabarang">Nama Barang</label>
                <input type="text" name='namabarang' class='form-control' value="<?php echo $namaBarang ?>" disabled> 
            </div>
            <div class="form-group">
                <label for="namabarang">Harga</label>
                <input type="text" name='hargasupplier' class='form-control' value="<?php echo $hargaSupplier ?>" >
            </div>
            <!-- <div class="form-group">
                <label for="namabarang">Edit Gambar</label>
                <input type="file" name='gambar' class='form-control'>
            </div> -->
            <div class="form-group">
                <input type="submit" class='btn btn-success' name='submit' value='submit' class='form-control'>
            </div>
            <!-- <div class="form-group">
                                <label for="namabarang">Nama Barang</label>
                                <input type="text" name='namabarang' class='form-control'>
                            </div> -->

        </form>
    </div>
</div>