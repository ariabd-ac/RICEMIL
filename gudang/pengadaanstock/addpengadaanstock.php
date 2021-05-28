<?php



require('../classsendmessage.php');
if (isset($_POST['submit'])) {

    $namaBarang = $_POST['namabarang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $np_sup = $_POST['np_sup'];
    $msg = $_POST['msg'];


    $query = "INSERT INTO tb_pengadaan_stock (Nama_barang,Harga,Jumlah) VALUES ('$namaBarang','$harga','$jumlah')";

    $insert = mysqli_query($conn, $query);
    if ($insert) {
        $last_id = mysqli_insert_id($conn);
        $linkMessage = "SEGERA CEK LINK <a href='http://localhost/ricemil/supplier/index.php?page=datapesanan&modul=konf&id=$last_id'>http://localhost/ricemil/supplier/index.php?page=datapesanan&modul=konf&id=" . $last_id . "</a>";
        // <a href="https://meet.google.com/vmu-mxrt-pux" title="https://meet.google.com/vmu-mxrt-pux" target="_blank" rel="noopener noreferrer" class="_3-8er selectable-text copyable-text">https://meet.google.com/vmu-mxrt-pux</a>
        $send->sendMessage($np_sup, $linkMessage . ',' . $msg); //kie ngirim wa
        $update = mysqli_query($conn, $queryUpdate);
        // update after get response OK from Supplier
        $queryUpdate = "UPDATE tb_barang tb SET tb.stock=(tb.stock + $jumlah) WHERE tb.Id_barang='$namaBarang'";
        if (!$update) {
            die("Err Update Stock " . mysqli_error($conn));
        }
        header('Location:/ricemil/gudang/index.php?page=pengadaanstock');
    } else {
        die('error ' . mysqli_error($conn));
    }
} else {
    $query = "SELECT * FROM tb_barang";
    $res = mysqli_query($conn, $query);
}


?>






<form action="" method="post">
    <div class="form-group">
        <label for="namabarang">Nama Barang</label>
        <select name="namabarang" id="" class='form-control'>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
                <option value="<?php echo $row['Id_barang'] ?>"><?php echo $row['Nama_barang'] ?></option>
            <?php    }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="namabarang">Jumlah</label>
        <input type="text" name='jumlah' class='form-control'>
    </div>
    <div class="form-group">
        <label for="namabarang">Harga</label>
        <input type="text" name='harga' class='form-control'>
    </div>
    <div class="form-group">
        <label for="namabarang">Pilih Supplier</label>
        <!-- <input type="text" name='no_sup' class='form-control'> -->
        <select name="np_sup" id="" class='form-control'>


            <?php
            $q = "SELECT phone,fname,lname from users WHERE level = 'supplier'";
            $rs = mysqli_query($conn, $q);
            // $rw = mysqli_fetch_assoc($rs);

            // var_dump($rw);
            // die;

            while ($rw = mysqli_fetch_assoc($rs)) {
            ?>
                <option value="<?php echo $rw['phone'] ?>">
                    <?php echo $rw['fname'] . " " . $rw['lname'] . " - " . $rw['phone'] ?>
                </option>
            <?php }

            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="namabarang">Memo</label>
        <input type="text" name='msg' class='form-control'>
    </div>
    <div class="form-group">
        <input type="submit" class='btn btn-success' name='submit' value='submit' class='form-control'>
    </div>
    <!-- <div class="form-group">
            <label for="namabarang">Nama Barang</label>
            <input type="text" name='namabarang' class='form-control'>
        </div> -->

</form>