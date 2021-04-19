<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM tb_barang WHERE Id_barang='$id'";
    $res = mysqli_query($conn, $query);
    if (!$res) {
        die("Err" . mysqli_error($conn));
    }

    $r = mysqli_fetch_assoc($res);
}

if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $jmlPesan = $_POST['jml'];
    $harga = $_POST['harga'];
    $user = $_SESSION['unique_id'];
    $metodeBayar = $_POST['metodebayar'];

    if ($jmlPesan == null || $jmlPesan == '') {
        die('harap Masukan Jumlah Pesanan');
    }
    $total = (float)$harga * (float)$jmlPesan;

    $queryInser = "INSERT INTO tb_order_masuk(Id_barang,qty,total,order_by,metode_bayar) VALUES ('$id','$jmlPesan','$total','$user','$metodeBayar')";
    $insert = mysqli_query($conn, $queryInser);
    if ($insert) {
        $updateQuey = "UPDATE tb_barang tb SET tb.stock=(tb.stock - $jmlPesan) WHERE tb.Id_barang='$id'";

        $updateExec = mysqli_query($conn, $updateQuey);
        if ($updateExec) {
            header('Location:/ricemil/reseller/index.php?page=barang');
        } else {
            die('erro Update Stock' . mysqli_error($conn));
        }
    } else {
        die('erro ' . mysqli_error($conn));
    }
}
?>
<div class="container d-flex align-center justify-content-center">
    <div class="card">
        <div class="card-body">
            <div class='d-flex align-center justify-content-center'>
                <img src="http://localhost/ricemil/assets/images/produk/<?php echo $r['gambar'] ?>" alt="" width="350px">
            </div>
            <div class="desc">
                <h4><?php echo $r['Nama_barang'] ?></h4>
                <p>Stock <span id='stock'><?php echo $r['stock'] ?></span></p>
                <p>Rp. <?php echo $r['harga'] ?></p>
            </div>
        </div>
        <div class="card-footer">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $r['Id_barang']; ?>">
                <input type="text" class='form-control' id='jml' name='jml'>
                <input type="hidden" class='form-control' name='harga' value="<?php echo $r['harga'] ?>">
                <br>
                <div class="form-group" id="metodepembayaran" style="display:none;">
                    <label for="">Metode Pembayaran</label>
                    <select name="metodebayar" id="metodebayar" class='form-control'>
                        <option value="0">....</option>
                        <option value="1">COD</option>
                        <option value="2">Upload Bukti Transaksi</option>
                    </select>
                </div>
                <input type="submit" name="submit" id='submit' class='btn btn-info form-control' value="Pesan Sekarang">
            </form>
        </div>
    </div>
</div>
<script>
    let stock = document.getElementById('stock');
    let inputName = document.getElementById('jml');
    let btnSubmit = document.getElementById('submit');
    let inputMetode = document.getElementById('metodebayar');
    let divMetode = document.getElementById('metodepembayaran');

    inputName.addEventListener('input', (e) => {
        console.log(inputName.value);
        if (Number(inputName.value) > Number(stock.innerHTML)) {
            alert('Stock Tidak Cukup');
            inputName.value = ''
        }
    })

    submit.addEventListener('click', (e) => {

        if (inputName.value == '' || inputName.value == null) {
            e.preventDefault();
            alert('Masukan Jumlah Pesanan')
        }
        if (inputMetode.value == 0) {
            e.preventDefault();
            divMetode.style.display = 'block';
        }
    })
</script>