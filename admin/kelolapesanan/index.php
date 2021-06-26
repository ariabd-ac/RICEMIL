<div class="card">
    <div class="card-body">
        <!-- <a class='btn btn-success' href='/ricemil/gudang/index.php?page=pengadaanstock&modul=add'>Tambah</a> -->
        <table class="table user-table">
        <thead>
            <tr>
                <th class="border-top-0">#</th>
                <th class="border-top-0">Oleh</th>
                <th class="border-top-0">Tanggal</th>
                <th class="border-top-0">Subtotal</th>
                <th class="border-top-0">Diskon</th>
                <th class="border-top-0">Total</th>
                <th class="border-top-0">Metode Bayar</th>
                <th class="border-top-0">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //   die('Halo');
                $query="SELECT TOM.date,TOM.Id_order,TOM.is_approve,TOM.total,TOM.diskon,TOM.subtotal,
                CONCAT(U.fname,' ',U.lname) AS oleh,
                TMB.descr
                FROM tb_order_masuk TOM
                LEFT JOIN users U ON U.unique_id=TOM.order_by
                LEFT JOIN tb_rf_metodebayar TMB ON TMB.id=TOM.metode_bayar 
                ORDER BY TOM.date DESC";
                $result=mysqli_query($conn,$query);
                if(!$result){
                    die('Err'.mysqli_error($conn));
                }
                while($row=mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo $row['Id_order']?></td>
                        <td><?php echo $row['oleh'] ?></td>
                        <td><?php echo $row['date']?></td>
                        <td><?php echo $row['subtotal']?></td>
                        <td><?php echo $row['diskon']?></td>
                        <td><?php echo $row['total']  ?></td>
                        <td><?php echo $row['descr'] ?></td>
                        <td><?php echo $row['is_approve'] ? 'Approved' :'Waiting to be Approved' ?></td>
                        <td>
                            <a class='btn btn-info' href="/ricemil/admin/index.php?page=kelolapesanan&modul=detail&id=<?php echo $row['Id_order'] ?>">Detail</a>
                        </td>
                    </tr>
            <?php    
                }
            ?>
        </tbody>
        </table>
    </div>
</div>

