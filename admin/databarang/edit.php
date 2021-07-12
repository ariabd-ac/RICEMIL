<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}



if (isset($_POST['submit'])) {
    $namaBarang = $_POST['namabarang'];
    $harga = $_POST['harga'];
    // $jumlah = $_POST['jumlah'];
    $succesUpload = false;

    $gambar = $_FILES['gambar'];
    $root = realpath(dirname(__FILE__));

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
    if ($succesUpload) {
        $query = "UPDATE tb_barang SET Nama_barang='$namaBarang',harga='$harga',gambar='$gambar[name]' WHERE Id_barang='$id'";
    } else {
        echo "<script>alert('Gagal Upload File')</script>";
        die();
        // $query = "INSERT INTO tb_barang (Nama_barang,harga) VALUES ('$namaBarang','$harga')";
    }
    

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
        $gambarFile=$hasil['gambar'];
    } else {
        die('error ' . mysqli_error($conn));
    }
}
?>





<div class="card">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div style='display:flex;justify-content:center;align-items:center;'>
                <img src="http://localhost/ricemil/assets/images/produk/<?php echo $gambarFile ?>" alt="" height="300px" width="300px">
            </div>
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
                <label for="namabarang">Edit Gambar</label>
                <input type="file" name='gambar' class='form-control'>
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