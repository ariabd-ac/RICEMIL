<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_POST['submit'])) {
    $namaBarang = $_POST['namabarang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    $query = "UPDATE tb_barang SET Nama_barang='$namaBarang',harga='$harga' WHERE Id_barang='$id'";

    $insert = mysqli_query($conn, $query);
    if ($insert) {
        header('location:/ricemil/admin/index.php?page=databarang');
    } else {
        die('error ' . mysqli_error($conn));
    }
} else {

    $query = "SELECT * FROM tb_barang WHERE Id_barang=$id";

    $insert = mysqli_query($conn, $query);
    if ($insert) {
        $hasil = mysqli_fetch_assoc($insert);
        $kodebarang = $hasil['Id_barang'];
        $namaBarang = $hasil['Nama_barang'];
        $harga = $hasil['harga'];
    } else {
        die('error ' . mysqli_error($conn));
    }
}
?>






<form action="" method="post">
    <div class="form-group">
        <label for="namabarang">Kode Barang</label>
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
        <input type="submit" class='btn btn-success' name='submit' value='submit' class='form-control'>
    </div>
    <!-- <div class="form-group">
                        <label for="namabarang">Nama Barang</label>
                        <input type="text" name='namabarang' class='form-control'>
                    </div> -->

</form>