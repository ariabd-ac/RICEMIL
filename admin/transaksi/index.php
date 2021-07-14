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
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Menunggu Di Kirim</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Dikirim</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Selesai</button>
        </li>
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="profile-tab">
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
                    <th class="border-top-0">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //   die('Halo');
                    $query="SELECT 
                            T.Tanggal_transaksi AS date,T.Total_bayar,T.status,T.Id_transaksi,T.subtotal,T.diskon,T.order_by,
                            CONCAT(U.fname,' ',U.lname) AS oleh
                            FROM tb_transaksi T
                            LEFT JOIN users U ON U.unique_id=T.Id_pelanggan
                            ORDER BY T.Tanggal_transaksi DESC";
                    $result=mysqli_query($conn,$query);
                    if(!$result){
                        die('Err'.mysqli_error($conn));
                    }
                    while($row=mysqli_fetch_assoc($result)){
                        $idSebelum=null;
                        if($row['status']=='1' && $row['Id_transaksi'] != $idSebelum){
                            $idSebelum=$row['Id_transaksi'];
                            
                            ?>
                            <tr>
                                <td><?php echo $row['Id_transaksi']?></td>
                                <td><?php echo $row['oleh'] ?></td>
                                <td><?php echo $row['date']?></td>
                                <td><?php echo $row['subtotal']?></td>
                                <td><?php echo $row['diskon']?></td>
                                <td><?php echo $row['Total_bayar'] ?></td>
                                <td><?php echo $row['status'] ? 'Diproses' : 'Dikirim' ?></td>
                                <!-- <td>
                                    <form action="" method="post">
                                        <input type="hidden" value="<?php echo $row['Id_transaksi']?>" name='id'>
                                        <input type="hidden" value="2" name='status'>
                                        <input type="submit" value="Dikirim" class='btn btn-info' name='submit'>
                                    </form>
                                </td> -->
                                <td>
                                    <a class='btn btn-info' href="/ricemil/admin/index.php?page=transaksi&modul=detail&id=<?php echo $row['Id_transaksi'] ?>">Detail</a>
                                </td>
                            </tr>
                <?php    
                    }}
                ?>
            </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                    <th class="border-top-0">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $result=mysqli_query($conn,$query);
                    if(!$result){
                        die('Err'.mysqli_error($conn));
                    }
                    while($row=mysqli_fetch_assoc($result)){
                        
                        if($row['status']==='2'){?>
                            <tr>
                            <td><?php echo $row['Id_transaksi']?></td>
                                <td><?php echo $row['oleh'] ?></td>
                                <td><?php echo $row['date']?></td>
                                <td><?php echo $row['subtotal']?></td>
                                <td><?php echo $row['diskon']?></td>
                                <td><?php echo $row['Total_bayar'] ?></td>
                                <td>sedang Dikirim</td>
                                <td>
                                <a class='btn btn-info' href="/ricemil/admin/index.php?page=transaksi&modul=detail&id=<?php echo $row['Id_transaksi'] ?>">Detail</a>
                                <form action="" method="post">
                                        <input type="hidden" value="<?php echo $row['Id_transaksi']?>" name='id'>
                                        <input type="hidden" value="3" name='status'>
                                        <input type="submit" value="Tandai Selesai" class='btn btn-info' name='submit'>
                                    </form>
                                </td>
                            </tr>
                <?php    
                    }}
                ?>
            </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
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
                    $result=mysqli_query($conn,$query);
                    if(!$result){
                        die('Err'.mysqli_error($conn));
                    }
                    while($row=mysqli_fetch_assoc($result)){
                        if(($row['status']=='3' || $row['status']=='4') && $row['order_by'] !== null){?>
                            <tr>
                                <td><?php echo $row['Id_transaksi']?></td>
                                <td><?php echo $row['oleh'] ?></td>
                                <td><?php echo $row['date']?></td>
                                <td><?php echo $row['subtotal']?></td>
                                <td><?php echo $row['diskon']?></td>
                                <td><?php echo $row['Total_bayar'] ?></td>
                                <td><?php echo $row['status'] == '3' ? 'Menunggu Konfirmasi Pelanggan' : 'Transaksi Telah Selesai' ?></td>
                                <td>
                                <a class='btn btn-info' href="/ricemil/admin/index.php?page=transaksi&modul=detail&id=<?php echo $row['Id_transaksi'] ?>">Detail</a>
                                </td>
                            </tr>
                <?php    
                    }}
                ?>
            </tbody>
            </table>
        </div>
        </div>
    
    </div>
</div>


