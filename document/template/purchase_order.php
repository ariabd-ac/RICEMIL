<?php
session_start();
    $id=$_GET['id'];
    $kasir=$_SESSION['unique_id'];

    $total=0;
    $kembalian=0;

    $nameUserQuery="SELECT CONCAT(fname,' ',lname) AS name FROM users WHERE unique_id='$kasir'";
    $result=mysqli_fetch_assoc(mysqli_query($conn,$nameUserQuery));

    $nameUserSupplier="SELECT CONCAT(fname,' ',lname) AS name FROM users WHERE phone=(SELECT supplier_nohp FROM tb_pengadaan_stock WHERE id='$id')";
    $res=mysqli_fetch_assoc(mysqli_query($conn,$nameUserSupplier));
    $queryPO="SELECT no_po FROM tb_pengadaan_stock WHERE id='$id'";
    
   
    $noPo=mysqli_fetch_assoc(mysqli_query($conn,$queryPO))['no_po'];
?>

<h1 style="text-align:center;">Grosir Amelia</h1>
<hr>
<table style='width:100%'>
    <tr>
        <td nowrap>Gudang</td>
        <td nowrap>:</td>
        <td nowrap><?php echo $result['name'] ?></td>
        <td style='width:50%'></td>
        <td nowrap>Supplier</td>
        <td nowrap>:</td>
        <td nowrap><?php echo $res['name'] ?></td>
    </tr>
    <tr>
        <td  nowrap>Tanggal Transaksi</td>
        <td  nowrap>:</td>
        <td nowrap><?php echo date('d M Y') ?></td>
        <td nowrap></td>
        <td nowrap>No PO</td>
        <td nowrap>:</td>
        <td nowrap><?php echo $noPo?></td>
    </tr>
</table>

<table style="width:100%">
    <thead>
        <tr>
            <td style="text-align:center;border-top:1px solid black;border-bottom:1px solid black;">No</td>
            <td style="text-align:center;border-top:1px solid black;border-bottom:1px solid black;">Nama Barang</td>
            <td style="text-align:center;border-top:1px solid black;border-bottom:1px solid black;">Harga</td>
            <td style="text-align:center;border-top:1px solid black;border-bottom:1px solid black;">Qty</td>
            <!-- <td style="text-align:center;border-top:1px solid black;border-bottom:1px solid black;">Jumlah Reject</td> -->
            <td style="text-align:center;border-top:1px solid black;border-bottom:1px solid black;">SubTotal</td>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT 
            TPS.Total,TPS.tanggal_transaksi,TPS.Id,
            TPSD.harga,TPSD.qty,TPSD.appproved_by,TPSD.id_pengadaan_stock,TPSD.id AS id_detail_pengadaan_stock,TPSD.status,TPSD.qty_rejected,
            TB.Nama_barang,TB.gambar,TB.Id_barang
            FROM tb_pengadaan_stock TPS 
            LEFT JOIN tb_pengadaan_stock_detail TPSD ON TPSD.id_pengadaan_stock=TPS.Id
            LEFT JOIN tb_barang TB ON TPSD.id_item=TB.Id_barang 
            WHERE TPS.Id='$id'";
            $exec=mysqli_query($conn,$query);
            if(!$exec){
                die(mysqli_error($conn));
            }
            $no=0;
            while($r=mysqli_fetch_assoc($exec)){
            $total=$total + ($r['harga'] * ($r['qty'] - $r['qty_rejected']));
            $no=$no+1;
        ?>
            <tr>
                <td style="text-align:center;"><?= $no ?></td>
                <td style="text-align:left;"><?php echo $r['Nama_barang']?></td>
                <td style="text-align:right;"><?php echo "Rp ". $r['harga']?></td>
                <td style="text-align:center;"><?php echo $r['qty']?></td>
                <!-- <td style="text-align:right;"><?php echo $r['qty_rejected']?></td> -->
                <td style="text-align:right;"><?php echo "Rp ". ($r['harga'] * ($r['qty'] -  $r['qty_rejected'] ) )?></td>
            </tr>
        <?php 
            }
        ?>
    </tbody>
<table>
<hr>
<table style="width:100%">
    <!-- <tr>
        <td style="width:20%">Subtotal</td>
        <td style="text-align:right;"><?php echo "Rp ".$total ?></td>
    </tr> -->
    <!-- <tr>
        <td style="width:20%">Diskon</td>
        <td style="text-align:right;"><?php echo "Rp ".$diskon ?></td>
    </tr> -->
    <tr>
        <td style="width:20%">Total</td>
        <td style="text-align:right;"><?php echo "Rp ". $total ?></td>
    </tr>
    <!-- <tr>
        <td style="width:20%">Dibayar</td>
        <td style="text-align:right;"><?php echo "Rp ".$dibayar ?></td>
    </tr> -->
    <!-- <tr>
        <td style="width:20%">Kembalian</td>
        <td style="text-align:right;"><?php echo "Rp ". ($dibayar - ($total - $diskon)) ?></td>
    </tr> -->
</table>
<hr>
<br>
<br>
<br>
<table style='width:100%'>
    <tr>
        <td style='text-align:center;'>Gudang</td>
        <td style='width:50%'></td>
        <td style='text-align:center;'>Admin</td>
    </tr>
    <tr>
        <td style='height:50px;'></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td style='text-align:center;'><?php echo $result['name'] ?></td>
        <td></td>
        <td style='text-align:center;'>---------</td>
    </tr>
</table>