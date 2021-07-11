<?php
session_start();
    $uid=$_SESSION['unique_id'];

    $user =mysqli_fetch_assoc(mysqli_query($conn,"SELECT CONCAT(fname,' ',lname) AS name FROM users WHERE unique_id='$uid'"));
    $user= $user['name'];

    $query = "SELECT * FROM tb_transaksi_detail TPSD 
    LEFT JOIN tb_transaksi TPS ON TPS.Id_transaksi=TPSD.id_transaksi
    LEFT JOIN tb_barang TB ON TB.Id_barang=TPSD.id_item";

    $pertanggal ="";


    if(isset($_GET['startDate']) && isset($_GET['toDate'])){
        $startDate=$_GET['startDate'];
        $toDate=$_GET['toDate'];
        $query = "SELECT * FROM tb_transaksi_detail TPSD 
                LEFT JOIN tb_transaksi TPS ON TPS.Id_transaksi=TPSD.id_transaksi
                LEFT JOIN tb_barang TB ON TB.Id_barang=TPSD.id_item
                WHERE DATE(TPS.Tanggal_transaksi) BETWEEN '$startDate' AND '$toDate'";

            $pertanggal ="Transaksi per tanggal ".$startDate." s/d ".$toDate;
    }
?>

<h1 style="text-align:center;">Grosir Amelia</h1>
<p style="text-align:center">
    <?php echo $pertanggal ?>
</p>
<hr>
<table >
    <tr>
        <td >Dicetak Oleh</td>
        <td >:</td>
        <td ><?php echo $user ?></td>
    </tr>
    <tr>
        <td >Tanggal Cetak</td>
        <td >:</td>
        <td><?php echo date('d M Y H:i:s') ?></td>
    </tr>
</table>


<br>
<br>
<br>

<table class="table user-table" style="width:100%">
    <thead>
        <tr>
            <th style="border-bottom:1px solid black;">#</th>
            <th style="border-bottom:1px solid black;">Tanggal Transaksi</th>
            <th style="border-bottom:1px solid black;">Nama Barang</th>
            <th style="border-bottom:1px solid black;">Jumlah</th>
            <th style="border-bottom:1px solid black;">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        // $query = "SELECT * FROM tb_pengadaan_stock";
        // $query = "SELECT * FROM tb_pengadaan_stock TPS
        //             WHERE TPS.supplier_nohp=(SELECT phone FROM users WHERE unique_id='$_SESSION[unique_id]')";
        $result = mysqli_query($conn, $query);

        if(!$result){
            die(mysqli_error($conn));
        }



        while ($row = mysqli_fetch_assoc($result)) {
            // var_dump($row);
            // die;
        ?>
            <tr>
                <td style='text-align:center;'><?php echo $row['Id_transaksi'] ?></td>
                <td style='text-align:center;'><?php echo $row['Tanggal_transaksi'] ?></td>
                <td style='text-align:center;'><?php echo $row['Nama_barang'] ?></td>
                <td style='text-align:center;'><?php echo $row['qty'] ?> Karung</td>
                <td style='text-align:right;'><?php echo $row['Total_bayar'] ?></td>
                
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>


<hr>


