
        <!-- <a class='btn btn-success' href='/ricemil/supplier/index.php?page=datapesanan&modul=add'>Tambah</a> -->
        <table class="table user-table">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">Tanggal Transaksi</th>
                    <th class="border-top-0">Total</th>
                    <th class="border-top-0">Status</th>
                    <th class="border-top-0">Action</th>
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
                            LEFT JOIN tb_barang TB ON TB.Id_barang=TPSD.id_item
                            WHERE TPSD.appproved_by='$_SESSION[unique_id]'";
                $result = mysqli_query($conn, $query);
                if(!$result){
                    die(mysqli_error($conn));
                }
                while ($row = mysqli_fetch_assoc($result)) {

                    $statusList=['Diproses','Dikirim','Selesai','Detail'];
                    $status=$row['status'] !== null && $row['status'] !== "" ? $row['status'] :0;
                ?>
                    <tr>
                        <td><?php echo $row['Id'] ?></td>
                        <td><?php echo $row['tanggal_transaksi'] ?></td>
                        <td><?php echo ($row['harga'] * $row['qty']) ?></td>
                        <td><?php echo $statusList[$status] ?></td>
                        <td>
                            <a class='btn btn-info' href="/ricemil/supplier/index.php?page=transaksi&modul=edit&id=<?php echo $row['Id']; ?>&status=<?php echo $status ?>"><?php echo $statusList[$status + 1] ?></a>                            
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    