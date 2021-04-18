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
                    ORDER BY T.Tanggal_transaksi DESC";
            $result=mysqli_query($conn,$query);
            if(!$result){
                die('Err'.mysqli_error($conn));
            }
            while($row=mysqli_fetch_assoc($result)){
                if($row['status']=='1'){?>
                    <tr>
                        <td><?php echo $row['Id_transaksi']?></td>
                        <td><?php echo $row['namaBarang']?></td>
                        <td><?php echo $row['date']?></td>
                        <td><?php echo $row['Jumlah']?></td>
                        <td><?php echo $row['Harga']?></td>
                        <td><?php echo $row['Total_bayar'] ?></td>
                        <td><?php echo $row['oleh'] ?></td>
                        <td><?php echo $row['status'] ? 'Diproses' : 'Dikirim' ?></td>
                        <td>
                            <a class='btn btn-info' href="/ricemil/admin/index.php?page=transaksi&modul=detail&id=<?php echo $row['Id_order'] ?>">Detail</a>
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
                        <td><?php echo $row['status'] ? 'Diproses' : 'Dikirim' ?></td>
                        <td>
                            <a class='btn btn-info' href="/ricemil/admin/index.php?page=transaksi&modul=detail&id=<?php echo $row['Id_order'] ?>">Detail</a>
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
                    ORDER BY T.Tanggal_transaksi DESC";
            $result=mysqli_query($conn,$query);
            if(!$result){
                die('Err'.mysqli_error($conn));
            }
            while($row=mysqli_fetch_assoc($result)){
                if($row['status']=='3'){?>
                    <tr>
                        <td><?php echo $row['Id_transaksi']?></td>
                        <td><?php echo $row['namaBarang']?></td>
                        <td><?php echo $row['date']?></td>
                        <td><?php echo $row['Jumlah']?></td>
                        <td><?php echo $row['Harga']?></td>
                        <td><?php echo $row['Total_bayar'] ?></td>
                        <td><?php echo $row['oleh'] ?></td>
                        <td><?php echo $row['status'] ? 'Diproses' : 'Dikirim' ?></td>
                        <td>
                            <a class='btn btn-info' href="/ricemil/admin/index.php?page=transaksi&modul=detail&id=<?php echo $row['Id_order'] ?>">Detail</a>
                        </td>
                    </tr>
        <?php    
            }}
        ?>
    </tbody>
    </table>
  </div>
</div>


