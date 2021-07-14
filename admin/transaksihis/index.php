<?php

if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $status=$_POST['status'];
    $queryUpdate="UPDATE tb_transaksi SET status='$status' WHERE Id_transaksi='$id'";

    $updateExec=mysqli_query($conn,$queryUpdate);
    if(!$updateExec){
        die('Err'.mysqli_error($conn));
    }else{
        header('location:/ricemil/admin/index.php?page=transaksi');
    }

}
?>
<div class="card">
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
                    <th class="border-top-0">Action</th>
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
                            WHERE T.status > 3
                            ORDER BY T.Tanggal_transaksi DESC";
                    $result=mysqli_query($conn,$query);
                    if(!$result){
                        die('Err'.mysqli_error($conn));
                    }
                    while($row=mysqli_fetch_assoc($result)){
                            ?>
                            <tr>
                                <td><?php echo $row['Id_transaksi']?></td>
                                <td><?php echo $row['oleh'] ?></td>
                                <td><?php echo $row['date']?></td>
                                <td><?php echo $row['subtotal']?></td>
                                <td><?php echo $row['diskon']?></td>
                                <td><?php echo $row['subtotal'] - $row['diskon'] ?></td>
                                <!-- <td>
                                    <form action="" method="post">
                                        <input type="hidden" value="<?php echo $row['Id_transaksi']?>" name='id'>
                                        <input type="hidden" value="2" name='status'>
                                        <input type="submit" value="Dikirim" class='btn btn-info' name='submit'>
                                    </form>
                                </td> -->
                                <td>
                                    <a class='btn btn-info' href="/ricemil/admin/index.php?page=transaksihis&modul=detail&id=<?php echo $row['Id_transaksi'] ?>">Detail</a>
                                </td>
                            </tr>
                <?php    
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>


