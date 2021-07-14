<div class="card">
    <div class="card-body">
    <table class="table user-table">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">Tanggal Transaksi</th>
                    <th class="border-top-0">Nama Barang</th>
                    <th class="border-top-0">Qty</th>
                    <th class="border-top-0">Supplier</th>
                    <th class="border-top-0">Total</th>
                    <th class="border-top-0">Status</th>
                    <th class="border-top-0">Jumlah Reject</th>
                    <!-- <th class="border-top-0">Action</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                // $query = "SELECT * FROM tb_pengadaan_stock TPS 
                //             LEFT JOIN tb_pengadaan_stock_detail TPSD ON TPS.Id=TPSD.id_pengadaan_stock
                //             LEFT JOIN tb_barang TB ON TB.Id=TPSD.id_item
                //             WHERE TPS.supplier_nohp=(SELECT phone FROM users WHERE unique_id='$_SESSION[unique_id]')";
                $query = "SELECT * FROM tb_pengadaan_stock_detail TPSD
                            LEFT JOIN tb_pengadaan_stock TPS ON TPS.Id=TPSD.id_pengadaan_stock 
                            LEFT JOIN users U ON U.unique_id=TPSD.appproved_by
                            LEFT JOIN tb_barang TB ON TB.Id_barang=TPSD.id_item
                            WHERE (TPSD.appproved_by='$_GET[id]' AND TPSD.status='2') OR TPSD.is_rejected='1'";
                $result = mysqli_query($conn, $query);
                if(!$result){
                    die(mysqli_error($conn));
                }
                while ($row = mysqli_fetch_assoc($result)) {

                    $statusList=['Accepted','Rejected'];
                    $status=$row['status'] ? $row['status'] :0;
                ?>
                    <tr>
                        <td><?php echo $row['Id'] ?></td>
                        <td><?php echo $row['tanggal_transaksi'] ?></td>
                        <td><?php echo $row['Nama_barang'] ?></td>
                        <td><?php echo $row['qty'] ?></td>
                        <td><?php echo $row['fname'].' '.$row['lname'] ?></td>
                        <td><?php echo ($row['harga'] * $row['qty']) ?></td>
                        <td><?php echo $statusList[0] ?></td>
                        <td><?php echo $row['qty_rejected'] ?></td>
                        <!-- <td>
                            <a class='btn btn-info' href="/ricemil/gudang/index.php?page=transaksisupplier&modul=edit&id=<?php echo $row['id']; ?>&status=<?php echo $status ?>">Detail</a>                            
                        </td> -->
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>        
    </div>
</div>   
   
    