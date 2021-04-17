<a class='btn btn-success' href='/ricemil/gudang/index.php?page=pengadaanstock&modul=add'>Tambah</a>
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
          $query="SELECT TB.Nama_barang AS namaBarang,TB.Harga,TB.Id_barang,TOM.date,TOM.qty AS Jumlah FROM tb_order_masuk TOM LEFT JOIN tb_barang TB ON TB.Id_barang=TOM.Id_barang WHERE TOM.order_by='$_SESSION[unique_id]' ORDER BY TOM.date DESC";
          $result=mysqli_query($conn,$query);
          if(!$result){
              die('Err'.mysqli_error($conn));
          }
          while($row=mysqli_fetch_assoc($result)){
              ?>
              <tr>
                  <td><?php echo $row['Id_barang']?></td>
                  <td><?php echo $row['namaBarang']?></td>
                  <td><?php echo $row['date']?></td>
                  <td><?php echo $row['Jumlah']?></td>
                  <td><?php echo $row['Harga']?></td>
                  <td><?php echo ($row['Harga'] * $row['Jumlah']) ?></td>
              </tr>
      <?php    
          }
      ?>
  </tbody>
</table>
