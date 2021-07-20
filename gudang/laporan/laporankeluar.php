<?php
    $startDate=null;
    $toDate=null;
    if(isset($_POST['submit'])){
        $startDate=$_POST['startDate'];
        $toDate=$_POST['toDate'];

        $header2='Per tanggal '.$startDate.' s/d '.$toDate;
    }

    if($startDate && $toDate){
        $urlPrint="http://localhost/ricemil/document/index.php?template=laporankeluar&startDate=$startDate&toDate=$toDate";
    }else{
        $urlPrint="http://localhost/ricemil/document/index.php?template=laporankeluar&startDate=";
    }

?>
<h1>Laporan Keluar barang</h1>
<?php if($startDate && $toDate){ ?>
    <p><?php echo $header2?></p>
<?php } ?>
<!-- <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Filter
</button> -->
<a href="<?php echo $urlPrint ?>" target="_blank" class="btn btn-primary" type="button">
    Print
</a>

<br>
<br>
<div id="collapseExample">
  <div class="card card-body">
  <form action="" method='POST'>
    <div class="row">
        <div class="col-md-5">
            <label for="startDate">Start Date</label>
            <input type="date" class='form-control' name='startDate' value="<?= $startDate ?>">
        </div>
        <div class="col-md-5">
            <label for="startDate">To Date</label>
            <input type="date" class='form-control' name='toDate' value="<?= $toDate ?>">
        </div>
        <div class="col-md-2">
                <label for="startDate"></label>
            <input type="submit" value="submit" class='form-control btn-info' name='submit' >
        </div>
    </div>
  </form>
  </div>
</div>

<table class="table user-table">
    <thead>
        <tr>
            <th class="border-top-0">#</th>
            <th class="border-top-0">Tanggal Transaksi</th>
            <th class="border-top-0">Nama Barang</th>
            <th class="border-top-0">Jumlah</th>
            <!-- <th class="border-top-0">Action</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
        if($startDate && $toDate){
            $query = "SELECT * FROM tb_transaksi_detail TPSD 
                    LEFT JOIN tb_transaksi TPS ON TPS.Id_transaksi=TPSD.id_transaksi
                    LEFT JOIN tb_barang TB ON TB.Id_barang=TPSD.id_item
                    WHERE DATE(TPS.Tanggal_transaksi) BETWEEN '$startDate' AND '$toDate'
                    AND TPS.status='4'";
        }else{
            $query = "SELECT * FROM tb_transaksi_detail TPSD 
                        LEFT JOIN tb_transaksi TPS ON TPS.Id_transaksi=TPSD.id_transaksi
                        LEFT JOIN tb_barang TB ON TB.Id_barang=TPSD.id_item
                        WHERE TPS.status='4'";
        }
        
        $result = mysqli_query($conn, $query);

        if(!$result){
            die(mysqli_error($conn));
        }


        $num=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $num=$num+1;
        ?>
            <tr>
                <td><?php echo $num ?></td>
                <td><?php echo $row['Tanggal_transaksi'] ?></td>
                <td><?php echo $row['Nama_barang'] ?></td>
                <td><?php echo $row['qty'] ?><?php echo $row['Id_pelanggan'] ? " Karung":" Kg";?> </td>
                
                <!-- <td>
                    <a class='btn btn-info' href="/ricemil/gudang/index.php?page=pengadaanstock&modul=edit&id=<?php echo $row['Id']; ?>">Detail</a>
                </td> -->
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>