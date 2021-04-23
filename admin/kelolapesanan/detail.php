<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query="SELECT TB.Nama_barang AS namaBarang,TB.Harga,TB.Id_barang,TOM.date,TOM.Id_order,TOM.metode_bayar,TOM.qty AS Jumlah,
          CONCAT(U.fname,' ',U.lname) AS oleh,U.unique_id,
          TMB.descr,TOM.struk_gambar
          FROM tb_order_masuk TOM 
          LEFT JOIN tb_barang TB ON TB.Id_barang=TOM.Id_barang
          LEFT JOIN users U ON U.unique_id=TOM.order_by
          LEFT JOIN tb_rf_metodebayar TMB ON TMB.id=TOM.metode_bayar
          WHERE Id_order='$id' 
          ORDER BY TOM.date DESC";
    $result=mysqli_query($conn,$query);
    if(!$result){
        die('Err'.mysqli_error($conn));
    }
    $res=mysqli_fetch_assoc($result);
}

if (isset($_POST['submit'])) {
    $id=$_POST['kodepesanan'];
    
    $query = "UPDATE tb_order_masuk SET is_approve=TRUE WHERE Id_order='$id'";

    $insert = mysqli_query($conn, $query);
    if ($insert) {
        $totalBayar=(float) $res['Jumlah'] * (float) $res['Harga'];
        $queryInsertTransaksi="INSERT INTO tb_transaksi (Id_pelanggan,Tanggal_transaksi,id_barang,Harga,Jumlah_pesanan,Total_bayar,status) 
        VALUES ('$res[unique_id]','$res[date]','$res[Id_barang]','$res[Harga]','$res[Jumlah]','$totalBayar','1')";

        if(mysqli_query($conn,$queryInsertTransaksi)){

            header('location:/ricemil/admin/index.php?page=kelolapesanan');
        }else{
            die('Err'.mysqli_error($conn));
        }
    } else {
        die('error ' . mysqli_error($conn));
    }
}
?>




<div class="card">
    <div class="card-body">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="namabarang">Kode Pesanan</label>
                    <input type="hidden" name='kodepesanan' class='form-control' value="<?php echo $res['Id_order'] ?>">
                    <input type="text" name='' class='form-control' value="<?php echo $res['Id_order'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="namabarang">Nama Barang</label>
                    <input type="text" name='namabarang' class='form-control' value="<?php echo $res['namaBarang'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="namabarang">Tanggal Order</label>
                    <input type="text" name='harga' class='form-control' value="<?php echo $res['date'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="namabarang">Harga Barang</label>
                    <input type="text" name='harga' class='form-control' value="<?php echo $res['Harga'] ?>" disabled>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="namabarang">Jumlah Order</label>
                    <input type="text" name='harga' class='form-control' value="<?php echo $res['Jumlah'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="namabarang">Total</label>
                    <input type="text" name='harga' class='form-control' value="<?php echo ($res['Harga'] * $res['Jumlah'] )?>" disabled>
                </div>
                <div class="form-group">
                    <label for="namabarang">Oleh</label>
                    <input type="text" name='harga' class='form-control' value="<?php echo $res['oleh']?>" disabled>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="namabarang">Metode Pembayaran</label>
                            <input type="text" name='harga' class='form-control' value="<?php echo $res['descr']?>" disabled>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <?php
                                if($res['metode_bayar']=='2'){
                                    ?>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Lihat Bukti Pembayaran
                                        </button>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class='btn btn-success' name='submit' value='Approve' class='form-control'>
            </div>
        </form>

        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Foto Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                    if($res['struk_gambar']){
                ?>
                <img src="http://localhost/ricemil/assets/images/struk/<?php echo $res['struk_gambar'] ?>" alt="Foto Struk" style='width:100%'>
                <?php
                    }else{
                        echo "Customer Belum Mengupload Gambarnya";
                    }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
    
    </div>
</div>
