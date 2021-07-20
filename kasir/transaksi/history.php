<div class="card">
    <div class="card-header">
        History Transaksi Kasir
    </div>
    <div class="card-body">
        <table class="table user-table">
            <thead>
                <tr>
                <th class="border-top-0">#</th>
                    <th class="border-top-0">Oleh</th>
                    <th class="border-top-0">Tanggal</th>
                    <th class="border-top-0">Subtotal</th>
                    <th class="border-top-0">Diskon</th>
                    <th class="border-top-0">Total</th>
                    <th class="border-top-0">Status</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                //   die('Halo');
                    $query="SELECT 
                            T.Tanggal_transaksi AS date,T.Total_bayar,T.status,T.Id_transaksi,T.subtotal,T.diskon,
                            CONCAT(U.fname,' ',U.lname) AS oleh
                            FROM tb_transaksi T
                            LEFT JOIN users U ON U.unique_id=T.Id_pelanggan
                            ORDER BY T.Tanggal_transaksi DESC";
                    $result=mysqli_query($conn,$query);
                    $result=mysqli_query($conn,$query);
                    if(!$result){
                        die('Err'.mysqli_error($conn));
                    }
                    while($row=mysqli_fetch_assoc($result)){
                        if(($row['status']=='3' || $row['status']=='4') && $row['oleh'] == NULL){?>
                            <tr>
                                <td><?php echo $row['Id_transaksi']?></td>
                                <td><?php echo $row['oleh'] ?></td>
                                <td><?php echo $row['date']?></td>
                                <td><?php echo $row['subtotal']?></td>
                                <td><?php echo $row['diskon']?></td>
                                <td><?php echo $row['subtotal'] - $row['diskon'] ?></td>
                                <td><?php echo $row['status'] == '3' ? 'Menunggu Konfirmasi Pelanggan' : 'Transaksi Telah Selesai' ?></td>
                                <td>
                                <a class='btn btn-info' href="/ricemil/kasir/index.php?page=kasir&modul=historytransaksidetail&id=<?php echo $row['Id_transaksi'] ?>">Detail</a>
                                </td>
                            </tr>
                <?php    
                    }}
                ?>
            </tbody>
        </table>
    </div>
</div>

