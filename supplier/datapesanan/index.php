<div class="card">
    <div class="card-body">
        <a class='btn btn-success' href='/ricemil/supplier/index.php?page=datapesanan&modul=add'>Tambah</a>
        <table class="table user-table">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">Nama Barang</th>
                    <th class="border-top-0">Jumlah</th>
                    <th class="border-top-0">Harga</th>
                    <th class="border-top-0">Total</th>
                    <th class="border-top-0">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM tb_pengadaan_stock TPS LEFT JOIN tb_barang tb ON tb.Id_barang=TPS.Nama_barang";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['Id'] ?></td>
                        <td><?php echo $row['Nama_barang'] ?></td>
                        <td><?php echo $row['Jumlah'] ?></td>
                        <!-- <td><img src="http://localhost/ricemil/assets/images/produk/<?php echo $row['gambar'] ?>" alt="alter" height="100px" width="100px"></td> -->
                        <td><?php echo $row['Harga'] ?></td>
                        <td><?php echo ($row['Harga'] *  $row['Jumlah']) ?></td>
                        <td>
                            <?php
                            if ($row['is_approve'] != NULL) {
                            ?>
                                <span>Telah di konfirmasi</span>
                            <?php   } else { ?>
                                <a class='btn btn-info' href="/ricemil/supplier/index.php?page=datapesanan&modul=konf&id=<?php echo $row['Id']; ?>">Konfirmasi</a>
                            <?php
                            }
                            ?>
                            <a class='btn btn-danger' href="/ricemil/admin/index.php?page=databarang&modul=delete&id=<?php echo $row['Id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>