
        <!-- <a class='btn btn-success' href='/ricemil/supplier/index.php?page=datapesanan&modul=add'>Tambah</a> -->
        <table class="table user-table">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">Tanggal Transaksi</th>
                    <th class="border-top-0">Supplier</th>
                    <!-- <th class="border-top-0">Total</th> -->
                    <th class="border-top-0">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $isRejected=FALSE;
                if(isset($_GET['rejected'])){
                    $isRejected=TRUE;
                }
                $query = "SELECT * FROM tb_pengadaan_stock TPS
                        LEFT JOIN users U ON U.unique_id=(SELECT unique_id FROM users WHERE users.phone=TPS.supplier_nohp)
                        WHERE TPS.status='3'";
                $result = mysqli_query($conn, $query);
                if(!$result){
                    die(mysqli_error($conn));
                }
                $idBeforeTemp=null;
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['Id'] ?></td>
                        <td><?php echo $row['tanggal_transaksi'] ?></td>
                        <td><?php echo $row['fname'].' '.$row['lname'] ?></td>
                        <!-- <td><?php echo $row['Total'] ?></td> -->
                        <td>
                            <a class='btn btn-info' href="/ricemil/gudang/index.php?page=histransaksisupplier&modul=edit&id=<?php echo $row['Id']; ?><?= $isRejected ? "&rejected": "" ?>">Detail</a>                            
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    