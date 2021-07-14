<?php
    $id=$_GET['id'];

    if(isset($_POST['reject'])){
        // die($_POST['status']);
        // $statusPost=(int)$_POST['status'] + 1;
    
        // die($statusPost."STATUS POST");
        
        $queryUpdateStatusReject="UPDATE tb_pengadaan_stock_detail SET is_rejected=true,qty_rejected='$_POST[qty_rejected]',qty=(qty - $_POST[qty_rejected]) WHERE id='$id'";
        $execUpdateStatus=mysqli_query($conn,$queryUpdateStatusReject);
    
        if(!$execUpdateStatus){
            die(mysqli_error($conn));
        }else{
            header('Location:/ricemil/gudang/index.php?page=transaksisupplier');
        }
    }

    if(isset($_POST['submit'])){

    }else{
        $query = "SELECT * FROM tb_pengadaan_stock_detail TPSD
                LEFT JOIN tb_pengadaan_stock TPS ON TPS.Id=TPSD.id_pengadaan_stock 
                LEFT JOIN users U ON U.unique_id=TPSD.appproved_by
                LEFT JOIN tb_barang TB ON TB.Id_barang=TPSD.id_item
                WHERE TPSD.id='$id'";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die(mysqli_error($conn));
        }
        $data=mysqli_fetch_assoc($result);
    }
?>

<form action="" method="post">
    <div class="row">
        <div class="col-md-6">
            
            <div class="form-group">
                <label for="">Nama Barang</label>
                <input type="text" value="<?= $data['Nama_barang']?>" class='form-control'>
            </div>
            <div class="form-group">
                <label for="">Jumlah Pesan</label>
                <input type="text" value="<?= $data['qty']?>" class='form-control'>
            </div>
            <div class="form-group">
                <label for="">Total</label>
                <input type="text" value="Rp. <?= $data['harga'] * $data['qty']?>" class='form-control'>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Tanggal Transaksi</label>
                <input type="text" value="<?= $data['tanggal_transaksi']?>" class='form-control'>
            </div>
            <div class="form-group">
                <label for="">Nama Supplier</label>
                <input type="text" value="<?= $data['fname'].' '.$data['lname']?>" class='form-control'>
            </div>
            <?php
                $statusList=['Diproses','Dikirim','Selesai','Detail'];
                $status=$data['status'] ? $data['status'] :0;
            ?>
            <div class="form-group">
                <label for="">Status</label>
                <input type="text" value="<?= $statusList[$status] ?>" class='form-control'>
            </div>
        </div>
        <?php if($status == 2){?>
        <div class="form-group">
            <input type="hidden" name="status" value="<?php echo $_GET['status'] ? $_GET['status'] : 0 ?>">
            <input type="submit" class='btn btn-success' name='submit' value='Konfirmasi Selesai' class='form-control'>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Ajukan Return
            </button>
            <br>
            <br>
            <div class="row">
                <div class="form-group" id='form-reject' style='display:none;' class='col-md-3'>
                    <label for="">Jumlah yang di reject</label>
                    <input type="text" name="qty_rejected" id="qty_rejected"  class='form-control' style='width:100px;'>
                    <br>
                    <input type="submit" class='btn btn-info' name='reject' value='Reject' class='form-control'>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
    
</form>
<!-- Small modal -->


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <form action="" method="post">
            <div class="modal-header">
                Jumlah yang di reject
            </div>
            <div class="modal-body">
                <div class="form-group" id='form-reject'>
                    <input type="text" name="qty_rejected" id="qty_rejected"  class='form-control'>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class='btn btn-info' name='reject' value='Reject' class='form-control'>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- <script>
    document.getElementById('btn-reject').addEventListener('click',()=>{
        console.log("OKE")
        document.getElementById('form-reject').style.display='block';
    })
</script> -->