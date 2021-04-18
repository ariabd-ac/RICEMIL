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
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
  <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">...</div>
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


