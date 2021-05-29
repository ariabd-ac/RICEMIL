<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


if (isset($_POST['submit'])) {
    $approve = $_POST['approve'];
    $jumlah = $_POST['jumlah'];

    $query = "UPDATE tb_pengadaan_stock SET is_approve={$approve} WHERE Id='$id'";

    $insert = mysqli_query($conn, $query);
    if ($insert) {
        header('location:/ricemil/supplier/index.php?page=datapesanan');
    } else {
        die('error ' . mysqli_error($conn));
    }
} else {

    $query = "SELECT * FROM tb_pengadaan_stock TPS LEFT JOIN tb_barang tb ON tb.Id_barang=TPS.Nama_barang WHERE TPS.Id=" . $id;

    $insert = mysqli_query($conn, $query);
    if ($insert) {
        $hasil = mysqli_fetch_assoc($insert);
        $kodebarang = $hasil['Id'];
        $namaBarang = $hasil['Nama_barang'];
        $harga = $hasil['Harga'];
    } else {
        die('error ' . mysqli_error($conn));
    }
}
?>





<div class="card">
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="namabarang">Kode Pesanan</label>
                <input type="text" name='koedbarang' class='form-control' value="<?php echo $kodebarang ?>" disabled>
            </div>
            <div class="form-group">
                <label for="namabarang">Nama Barang</label>
                <input type="text" name='namabarang' class='form-control' value="<?php echo $namaBarang ?>">
            </div>
            <div class="form-group">
                <label for="namabarang">Harga Barang</label>
                <input type="text" name='harga' class='form-control' value="<?php echo $harga ?>">
            </div>
            <div class="form-group">
                <label for="namabarang">Konfirmasi ?</label>
                <select class="form-control" name="approve">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <!-- <input type="text" name='harga' class='form-control' value="<?php echo $harga ?>"> -->
            </div>

            <div class="form-group">
                <!-- <input type="submit" class='btn btn-success' name='not_approve' value='No' class='form-control'> -->
                <input type="submit" class='btn btn-success' name='submit' value='Save' class='form-control'>
            </div>
            <!-- <div class="form-group">
                                <label for="namabarang">Nama Barang</label>
                                <input type="text" name='namabarang' class='form-control'>
                            </div> -->

        </form>
    </div>
</div>