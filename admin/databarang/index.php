<a class='btn btn-success' href='/ricemil/admin/index.php?page=databarang&modul=add'>Tambah</a>
<table class="table user-table">
  <thead>
      <tr>
          <th class="border-top-0">#</th>
          <th class="border-top-0">Nama Barang</th>
          <th class="border-top-0">Action</th>
      </tr>
  </thead>
  <tbody>
      <?php
          $query="SELECT * FROM tb_barang";
          $result=mysqli_query($conn,$query);
          
          while($row=mysqli_fetch_assoc($result)){
              ?>
              <tr>
                  <td><?php echo $row['Id_barang']?></td>
                  <td><?php echo $row['Nama_barang']?></td>
                  <td>
                      <a class='btn btn-info' href="/ricemil/admin/index.php?page=databarang&modul=edit&id=<?php echo $row['Id_barang'];?>">Edit</a>
                      <a class='btn btn-danger' href="/ricemil/admin/index.php?page=databarang&modul=delete&id=<?php echo $row['Id_barang'];?>">Delete</a>
                  </td>
              </tr>
      <?php    
          }
      ?>
  </tbody>
</table>
