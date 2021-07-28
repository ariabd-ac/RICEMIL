<?php
$succesUpload = false;

if (isset($_POST['submit'])) {
    $namaBarang = $_POST['namabarang'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar'];
    $root = realpath(dirname(__FILE__));
    // die(var_dump($gambar));
    if ($gambar) {
        $targetDir =  $_SERVER["DOCUMENT_ROOT"] . '/ricemil/assets/images/produk/';

        $targetFile = $targetDir . basename($gambar['name']);
        $asal = $gambar['tmp_name'];

        if (move_uploaded_file($asal, $targetFile)) {
            $succesUpload = true;
        } else {
            die('error');
        }
    }
    // var_dump($gambar);die;
    if ($succesUpload) {
        $query = "INSERT INTO tb_barang (Nama_barang,harga,gambar) VALUES ('$namaBarang','$harga','$gambar[name]')";
    } else {
        echo "<script>alert('Gagal Upload File')</script>";
        $query = "INSERT INTO tb_barang (Nama_barang,harga) VALUES ('$namaBarang','$harga')";
    }

    $insert = mysqli_query($conn, $query);
    if ($insert) {
        header('Location:/ricemil/admin/index.php?page=databarang');
    } else {
        die('error ' . mysqli_error($conn));
    }
}
?>





<div class="card">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="namabarang">Nama Barang</label>
                <input type="text" name='namabarang' class='form-control' required
                        oninvalid="this.setCustomValidity('Nama Barang Wajib diisi')"
                        oninput="this.setCustomValidity('')">
            </div>
            <div class="form-group">
                <label for="namabarang">Harga Barang</label>
                <input type="number" name='harga' class='form-control' required
                        oninvalid="this.setCustomValidity('Harga Barang Wajib diisi')"
                        oninput="this.setCustomValidity('')">
            </div>
            <div class="form-group">
                <label for="namabarang">Gambar</label>
                <input type="file" name='gambar' class='form-control' required
                oninvalid="this.setCustomValidity('Gambar Wajib diisi')"
                        oninput="this.setCustomValidity('')">
            </div>
            <div class="form-group">
                <input type="submit" class='btn btn-success' name='submit' value='submit' class='form-control'>
            </div>
            <!-- <div class="form-group">
                    <label for="namabarang">Nama Barang</label>
                    <input type="text" name='namabarang' class='form-control'>
                </div> -->

        </form>
    </div>
</div>