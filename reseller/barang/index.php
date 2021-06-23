<div class="row">
    <?php
    $query = "SELECT * FROM tb_barang";
    $res = mysqli_query($conn, $query);

    if (!$res) {
        die('err' . mysqli_error($conn));
    }

    while ($r = mysqli_fetch_assoc($res)) {
    ?>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class='d-flex align-center justify-content-center'>
                        <a class='bg-image hover-overlay' href="/ricemil/reseller/index.php?page=barang&modul=detail&id=<?php echo $r['Id_barang']; ?>" style="text-decoration: none;">
                            <img src="http://localhost/ricemil/assets/images/produk/<?php echo $r['gambar'] ?>" alt="" width="100%">
                        </a>
                    </div>
                    <div class="desc">
                        <h4><?php echo $r['Nama_barang'] ?></h4>
                        <p>Stock <?php echo $r['stock'] ?></p>
                        <p>Rp. <?php echo $r['harga'] ?></p>
                    </div>
                </div>
                <div class="card-footer">
                    <!-- <a class='btn btn-info' href="/ricemil/reseller/index.php?page=barang&modul=detail&id=<?php echo $r['Id_barang']; ?>">Detail</a> -->
                </div>
            </div>
        </div>
    <?php } ?>
</div>