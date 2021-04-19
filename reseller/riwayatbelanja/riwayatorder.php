<?php
    if(isset($_POST['submit'])){
        $id=$_POST['id_order'];
        // die($id);
        $gambar=$_FILES['gambar_struk'];
        if ($gambar) {
            // var_dump($gambar);die;
            $namaGambar=$gambar['name'];
            $targetDir = 'C:/xampp/htdocs/RICEMIL/assets/images/struk/';
            $targetFile = $targetDir . basename($namaGambar);
            $asal = $gambar['tmp_name'];
    
            if (move_uploaded_file($asal, $targetFile)) {
                $query = "UPDATE tb_order_masuk SET struk_gambar='$namaGambar' WHERE Id_order='$id'";
                if(mysqli_query($conn,$query)){
                    header('Location:/ricemil/reseller/index.php?page=riwayatbelanja');
                }else{
                    die(mysqli_error($conn).'  Error Update DB');
                }
            } else {
                die('error');
            }
        }
    }
    if(isset($_POST['konfirm'])){
        $id=$_POST['id'];
        $status=$_POST['status'];
        $queryUpdate="UPDATE tb_transaksi SET status='$status' WHERE Id_transaksi='$id'";
    
        $updateExec=mysqli_query($conn,$queryUpdate);
        if(!$updateExec){
            die('Err'.mysqli_error($conn));
        }else{
            header('location:/ricemil/reseller/index.php?page=riwayatbelanja');
        }
    
    }
        
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Struk Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="gambar_struk" id="" class='form-control'>         
        <input type="hidden" id="inpIdOrder" name="id_order" id="" class='form-control'>         
      </div>
      <div class="modal-footer">
        <input type="submit" value="Upload" name="submit" class="btn btn-primary">
      </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- END MODAL -->

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Menunggu Konfirmasi</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Diproses</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Lagi OTW</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#selesai" type="button" role="tab" aria-controls="contact" aria-selected="false">Selesai</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <table class="table user-table">
        <thead>
            <tr>
                <th class="border-top-0">#</th>
                <th class="border-top-0">Nama Barang</th>
                <th class="border-top-0">Tanggal</th>
                <th class="border-top-0">Jumlah Order</th>
                <th class="border-top-0">Harga</th>
                <th class="border-top-0">Total</th>
                <th class="border-top-0">Upload Bukti Pembayaran</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            //   die('Halo');
                $query="SELECT TB.Nama_barang AS namaBarang,TB.Harga,TB.Id_barang,TOM.date,TOM.qty AS Jumlah,TOM.is_approve,
                TOM.metode_bayar,TBRM.descr,TOM.struk_gambar,TOM.Id_order 
                FROM tb_order_masuk TOM 
                LEFT JOIN tb_barang TB ON TB.Id_barang=TOM.Id_barang 
                LEFT JOIN tb_rf_metodebayar TBRM ON TBRM.id=TOM.metode_bayar
                WHERE TOM.order_by='$_SESSION[unique_id]' ORDER BY TOM.date DESC";
                $result=mysqli_query($conn,$query);
                if(!$result){
                    die('Err'.mysqli_error($conn));
                }
                while($row=mysqli_fetch_assoc($result)){
                    if(!$row['is_approve']){
                        
                    ?>
                        <tr>
                            <td><?php echo $row['Id_order']?></td>
                            <td><?php echo $row['namaBarang']?></td>
                            <td><?php echo $row['date']?></td>
                            <td><?php echo $row['Jumlah']?></td>
                            <td><?php echo $row['Harga']?></td>
                            <td><?php echo ($row['Harga'] * $row['Jumlah']) ?></td>
                            <td>
                                <?php
                                    if($row['metode_bayar'] != 1){
                                        if($row['struk_gambar']){
                                            echo 'Sudah Menguplod Bukti Pembayaran';   
                                        }else{
                                            
                                ?>      
                                    <button type="button" class="btn btn-primary" onclick="openModal(<?php echo $row['Id_order']?>)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Upload
                                    </button>  
                                    
                                <?php
                                        }
                                    }else{
                                        echo 'Tidak memerlukan Aksi ini ('.$row['descr'].')';
                                    }
                                
                                ?>
                            </td>
                        </tr>
            <?php   }    
                }
            ?>
        </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <table class="table user-table">
        <thead>
            <tr>
                <th class="border-top-0">#</th>
                <th class="border-top-0">Nama Barang</th>
                <th class="border-top-0">Tanggal</th>
                <th class="border-top-0">Jumlah Order</th>
                <th class="border-top-0">Harga</th>
                <th class="border-top-0">Total</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            //   die('Halo');
                $query="SELECT TB.Nama_barang AS namaBarang,TB.Harga,TB.Id_barang,TOM.date,TOM.qty AS Jumlah,TOM.is_approve 
                FROM tb_order_masuk TOM 
                LEFT JOIN tb_barang TB ON TB.Id_barang=TOM.Id_barang 
                WHERE TOM.order_by='$_SESSION[unique_id]' ORDER BY TOM.date DESC";
                $result=mysqli_query($conn,$query);
                if(!$result){
                    die('Err'.mysqli_error($conn));
                }
                while($row=mysqli_fetch_assoc($result)){
                    if($row['is_approve']){
                        
                    ?>
                        <tr>
                            <td><?php echo $row['Id_barang']?></td>
                            <td><?php echo $row['namaBarang']?></td>
                            <td><?php echo $row['date']?></td>
                            <td><?php echo $row['Jumlah']?></td>
                            <td><?php echo $row['Harga']?></td>
                            <td><?php echo ($row['Harga'] * $row['Jumlah']) ?></td>
                        </tr>
            <?php   }    
                }
            ?>
        </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
  <table class="table user-table">
    <thead>
        <tr>
            <th class="border-top-0">#</th>
            <th class="border-top-0">Nama Barang</th>
            <th class="border-top-0">Tanggal</th>
            <th class="border-top-0">Jumlah Order</th>
            <th class="border-top-0">Harga</th>
            <th class="border-top-0">Total</th>
            <th class="border-top-0">Oleh</th>
            <th class="border-top-0">Status</th>
            <th class="border-top-0">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //   die('Halo');
            $query="SELECT 
                    T.Tanggal_transaksi AS date,T.Jumlah_pesanan AS Jumlah,T.Harga,T.Total_bayar,T.status,T.Id_transaksi,
                    CONCAT(U.fname,' ',U.lname) AS oleh,
                    TB.Nama_barang AS namaBarang
                    FROM tb_transaksi T 
                    LEFT JOIN tb_barang TB ON TB.Id_barang=T.id_barang
                    LEFT JOIN users U ON U.unique_id=T.Id_pelanggan
                    WHERE T.Id_pelanggan='$_SESSION[unique_id]'
                    ORDER BY T.Tanggal_transaksi DESC";
            $result=mysqli_query($conn,$query);
            if(!$result){
                die('Err'.mysqli_error($conn));
            }
            while($row=mysqli_fetch_assoc($result)){
                if($row['status']=='2'){?>
                    <tr>
                        <td><?php echo $row['Id_transaksi']?></td>
                        <td><?php echo $row['namaBarang']?></td>
                        <td><?php echo $row['date']?></td>
                        <td><?php echo $row['Jumlah']?></td>
                        <td><?php echo $row['Harga']?></td>
                        <td><?php echo $row['Total_bayar'] ?></td>
                        <td><?php echo $row['oleh'] ?></td>
                        <td>Dikirim</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" value="<?php echo $row['Id_transaksi']?>" name='id'>
                                <input type="hidden" value="2" name='status'>
                                <input type="submit" value="Dikirim" class='btn btn-info' name='submit'>
                            </form>
                        </td>
                    </tr>
        <?php    
            }}
        ?>
    </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
  <table class="table user-table">
    <thead>
        <tr>
            <th class="border-top-0">#</th>
            <th class="border-top-0">Nama Barang</th>
            <th class="border-top-0">Tanggal</th>
            <th class="border-top-0">Jumlah Order</th>
            <th class="border-top-0">Harga</th>
            <th class="border-top-0">Total</th>
            <th class="border-top-0">Oleh</th>
            <th class="border-top-0">Status</th>
            <th class="border-top-0">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //   die('Halo');
            $query="SELECT 
                    T.Tanggal_transaksi AS date,T.Jumlah_pesanan AS Jumlah,T.Harga,T.Total_bayar,T.status,T.Id_transaksi,
                    CONCAT(U.fname,' ',U.lname) AS oleh,
                    TB.Nama_barang AS namaBarang
                    FROM tb_transaksi T 
                    LEFT JOIN tb_barang TB ON TB.Id_barang=T.id_barang
                    LEFT JOIN users U ON U.unique_id=T.Id_pelanggan
                    WHERE T.Id_pelanggan='$_SESSION[unique_id]'
                    ORDER BY T.Tanggal_transaksi DESC";
            $result=mysqli_query($conn,$query);
            if(!$result){
                die('Err'.mysqli_error($conn));
            }
            while($row=mysqli_fetch_assoc($result)){
                if($row['status']=='3' || $row['status']==4){?>
                    <tr>
                        <td><?php echo $row['Id_transaksi']?></td>
                        <td><?php echo $row['namaBarang']?></td>
                        <td><?php echo $row['date']?></td>
                        <td><?php echo $row['Jumlah']?></td>
                        <td><?php echo $row['Harga']?></td>
                        <td><?php echo $row['Total_bayar'] ?></td>
                        <td><?php echo $row['oleh'] ?></td>
                        <td><?php echo $row['status'] == '3' ? 'Menunggu Konfirmasi Pelanggan' : 'Transaksi Telah Selesai' ?></td>
                        <td>
                        <?php if($row['status'] == '3'){?>
                            <form action="" method="post">
                                <input type="hidden" value="<?php echo $row['Id_transaksi']?>" name='id'>
                                <input type="hidden" value="4" name='status'>
                                <input type="submit" value="Konfirmasi Barang Sudah Sampai" class='btn btn-info' name='konfirm'>
                            </form>
                        <?php 
                        }else{
                            echo 'Transaksi Telah Selesai';
                        }  
                        ?>
                           
                        </td>
                    </tr>
        <?php    
            }}
        ?>
    </tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<!-- Button trigger modal -->

<script>
    function openModal(id){
        let inputModalId=document.getElementById('inpIdOrder');
        console.log(id+'haloo dari fungsi')
        inputModalId.value=id;
    }
</script>


