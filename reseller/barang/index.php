<div class="row">
<?php
    $query="SELECT tb.*,tbs.stock FROM tb_barang tb LEFT JOIN tb_data_stock tbs ON tbs.Id_barang=tb.Id_barang";
    $res=mysqli_query($conn,$query);

    if(!$res){
        die('err'.mysqli_error($conn));
    }

    while($r=mysqli_fetch_assoc($res)){  
?>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class='d-flex align-center justify-content-center'>
                    <img src="http://localhost/ricemil/assets/images/produk/<?php echo $r['gambar']?>" alt="" width="350px">
                </div>
                <div class="desc">
                    <h4><?php echo $r['Nama_barang']?></h4>
                    <p>Stock <?php echo $r['stock']?></p>
                    <p>Rp. <?php echo $r['harga']?></p>
                </div>
            </div>
            <div class="card-footer">
                <button class='btn btn-info'>Pesan</button>
            </div>
        </div>
    </div>
<?php } ?>
</div>