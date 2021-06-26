<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query="SELECT TOM.date,TOM.Id_order,TOM.is_approve,TOM.total,TOM.diskon,TOM.subtotal,TOM.metode_bayar,TOM.struk_gambar,
            CONCAT(U.fname,' ',U.lname) AS oleh,
            TB.Nama_barang,
            TMB.descr,
            TOMD.id_detail,TOMD.harga,TOMD.qty
            FROM tb_order_masuk TOM
            LEFT JOIN tb_order_masuk_detail TOMD ON TOMD.id_order_masuk=TOM.Id_order
            LEFT JOIN tb_barang TB ON TB.Id_barang=TOMD.id_item
            LEFT JOIN users U ON U.unique_id=TOM.order_by
            LEFT JOIN tb_rf_metodebayar TMB ON TMB.id=TOM.metode_bayar
            WHERE TOM.Id_order='$id'";
    $result=mysqli_query($conn,$query);
    // var_dump($result);
    // die;
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
        
        $queryInsertTransaksi="INSERT INTO tb_transaksi (Id_pelanggan,Total_bayar,status) 
        VALUES ('$res[unique_id]','$res[total]','1')";

        

        if(mysqli_query($conn,$queryInsertTransaksi)){
            $resultDetail=mysqli_query($conn,$query);
            $idTrx=mysqli_insert_id($conn);
            while ($row=mysqli_fetch_assoc($resultDetail)) {
                
                $queryInsertTransaksiDetail="INSERT INTO tb_transaksi_detail (id_transaksi,id_item,harga,qty) VALUES ('$idTrx','$row[id_item]','$row[harga]','$row[qty]')";
                mysqli_query($conn,$queryInsertTransaksiDetail);
            }
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
        <form action="" method="post" class='row'>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body row">
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="namabarang">Kode Pesanan</label>
                                <input type="hidden" name='kodepesanan' class='form-control' value="<?php echo $res['Id_order'] ?>">
                                <input type="text" name='' class='form-control' value="<?php echo $res['Id_order'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="namabarang">Customer</label>
                                <input type="text" name='namabarang' class='form-control' value="<?php echo $res['oleh'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="namabarang">Tanggal Order</label>
                                <input type="text" name='harga' class='form-control' value="<?php echo $res['date'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="namabarang">Metode Pembayaran</label>
                                        <input type="text" name='harga' class='form-control' value="<?php echo $res['descr']?>" disabled>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end justify-content-center">
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
                        <div class="col-md-6">
                            <!-- <div class="form-group">
                                <label for="namabarang">Jumlah Order</label>
                                <input type="text" name='harga' class='form-control' value="<?php echo $res['Jumlah'] ?>" disabled>
                            </div> -->
                            <div class="form-group">
                                <label for="namabarang">SubTotal</label>
                                <input type="text" name='harga' class='form-control' value="<?php echo $res['subtotal']?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="namabarang">Diskon</label>
                                <input type="text" name='harga' class='form-control' value="<?php echo $res['diskon']?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="namabarang">Total</label>
                                <input type="text" name='harga' class='form-control' value="<?php echo $res['total']?>" disabled>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h3">Detail Transaksi</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Item</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col" colspan="2">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $resultDetail=mysqli_query($conn,$query);
                                    $num=0;
                                    while ($row=mysqli_fetch_assoc($resultDetail)) {
                                        $num+=1;
                                ?>
                                    <tr>
                                        <td scope="col"><?php echo $num ?></td>
                                        <td scope="col"><?php echo $row['Nama_barang'] ?></td>
                                        <td scope="col"><?php echo $row['harga'] ?></td>
                                        <td scope="col"><?php echo $row['qty'] ?></td>
                                        <td scope="col" colspan="2"><?php echo ($row['qty']* $row['harga']) ?></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php if(!$res['is_approve']) { ?>
            <div class="form-group">
                <input type="submit" class='btn btn-success' name='submit' value='Approve' class='form-control'>
            </div>
            <?php } ?>
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
