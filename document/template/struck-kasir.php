<?php
session_start();
    $idtrx=$_GET['id'];
    $kasir=$_SESSION['unique_id'];

    $total=0;
    $diskon=$_GET['discount'];
    $dibayar=$_GET['dibayar'];
    $kembalian=0;

    $nameUserQuery="SELECT CONCAT(fname,' ',lname) AS name FROM users WHERE unique_id='$kasir'";
    $result=mysqli_fetch_assoc(mysqli_query($conn,$nameUserQuery));


?>

<h1 style="text-align:center;">Grosir Amelia</h1>
<hr>
<table >
    <tr>
        <td >Kasir</td>
        <td >:</td>
        <td ><?php echo $result['name'] ?></td>
    </tr>
    <tr>
        <td >Tanggal Transaksi</td>
        <td >:</td>
        <td><?php echo date('d M Y H:i:s') ?></td>
    </tr>
</table>

<table style="width:100%">
    <thead>
        <tr>
            <td style="text-align:center;border-top:1px solid black;border-bottom:1px solid black;">Item</td>
            <td style="text-align:center;border-top:1px solid black;border-bottom:1px solid black;">Harga</td>
            <td style="text-align:center;border-top:1px solid black;border-bottom:1px solid black;">Kg</td>
            <td style="text-align:center;border-top:1px solid black;border-bottom:1px solid black;">SubTotal</td>
        </tr>
    </thead>
    <tbody>
        <?php
            $queryDetail="SELECT TD.harga,TD.qty,TB.Nama_barang 
                        FROM tb_transaksi_detail TD
                        LEFT JOIN tb_barang TB ON TB.Id_barang=TD.id_item
                        WHERE id_transaksi='$idtrx'";
            $exec=mysqli_query($conn,$queryDetail);
            if(!$exec){
                die(mysqli_error($conn));
            }
            while($r=mysqli_fetch_assoc($exec)){
            $total=$total + ($r['harga'] * $r['qty'])
        ?>
            <tr>
                <td style="text-align:left;"><?php echo $r['Nama_barang']?></td>
                <td style="text-align:right;"><?php echo "Rp ". $r['harga']?></td>
                <td style="text-align:center;"><?php echo $r['qty']?> Kg</td>
                <td style="text-align:right;"><?php echo "Rp ". ($r['harga'] * $r['qty'] )?></td>
            </tr>
        <?php 
            }
        ?>
    </tbody>
<table>
<hr>
<table style="width:100%">
    <tr>
        <td style="width:20%">Subtotal</td>
        <td style="text-align:right;"><?php echo "Rp ".$total ?></td>
    </tr>
    <tr>
        <td style="width:20%">Diskon</td>
        <td style="text-align:right;"><?php echo "Rp ".$diskon ?></td>
    </tr>
    <tr>
        <td style="width:20%">Total</td>
        <td style="text-align:right;"><?php echo "Rp ". ($total - $diskon) ?></td>
    </tr>
    <tr>
        <td style="width:20%">Dibayar</td>
        <td style="text-align:right;"><?php echo "Rp ".$dibayar ?></td>
    </tr>
    <tr>
        <td style="width:20%">Kembalian</td>
        <td style="text-align:right;"><?php echo "Rp ". ($dibayar - ($total - $diskon)) ?></td>
    </tr>
</table>
<hr>
<p style="text-align:center;">Terimakasih telah berbelanja</p>
<p style="text-align:center;">sampai jumpa dikunjungan berikutnya</p>
