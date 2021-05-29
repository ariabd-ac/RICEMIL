<a class='btn btn-success' href='/ricemil/gudang/index.php?page=pengadaanstock&modul=add'>Tambah</a>
<table class="table user-table">
    <thead>
        <tr>
            <th class="border-top-0">#</th>
            <th class="border-top-0">Nama Barang</th>
            <th class="border-top-0">Jumlah </th>
            <th class="border-top-0">Harga</th>
            <th class="border-top-0">Total</th>
            <th class="border-top-0">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT tp.*,tb.Nama_barang AS namaBarang FROM tb_pengadaan_stock tp LEFT JOIN tb_barang tb on tb.Id_barang=tp.Nama_barang";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>

                <td><?php echo $row['Id_barang'] ?></td>
                <td><?php echo $row['namaBarang'] ?></td>
                <td><?php echo $row['Jumlah'] ?></td>
                <td><?php echo $row['Harga'] ?></td>
                <td><?php echo ($row['Harga'] * $row['Jumlah']) ?></td>
                <td>
                    <a class='btn btn-info' href="/ricemil/gudang/index.php?page=pengadaanstock&modul=edit&id=<?php echo $row['Id_barang']; ?>">Edit</a>
                    <a class='btn btn-danger' href="/ricemil/gudang/index.php?page=pengadaanstock&modul=delete&id=<?php echo $row['Id_barang']; ?>">Delete</a>

                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>