<?php
    include_once "../../config/koneksi.php";
    require('../../classsendmessage.php');
    if(isset($_POST['submit'])){
        $total=$_POST['total'];
        $targetSupplier=$_POST['supplier'];
        $listItem=$_POST['itemList'];
        $np_sup=$_POST['supplier'];
        $tanggal_pengiriman=$_POST['tanggal_pengiriman'];
        // echo json_encode($listItem);
        // die;
        $no_po="PO".date('Ymd-Hi');
    // echo json_encode(array(
    //     "no_po"=>$no_po
    // ));
    // die;
        $queryInsert="INSERT INTO tb_pengadaan_stock (Total,supplier_nohp,no_po,tanggal_pengiriman) VALUES ('$total','$np_sup','$no_po','$tanggal_pengiriman')";
        
        
        $insert = mysqli_query($conn, $queryInsert);
        
        if ($insert) {
            
            $last_id = mysqli_insert_id($conn);
            $queryInsertDetail="INSERT INTO tb_pengadaan_stock_detail (id_pengadaan_stock,id_item,harga,qty) VALUES ";
            for ($i=0; $i < count($listItem); $i++) { 
                $qtyItem=$listItem[$i]['qty'];
                $hargaItem=$listItem[$i]['harga'];
                $idItem=$listItem[$i]['idItem'];
                $queryInsertDetail.="('$last_id','$idItem','$hargaItem','$qtyItem')";
                if(count($listItem)-1 !== $i){
                    $queryInsertDetail.=",";
                }
            }
            // die;
            // echo json_encode($queryInsertDetail);
            $insertDetail=mysqli_query($conn,$queryInsertDetail);

            if(!$insertDetail){
                echo json_encode(array(
                    "status"=>"GAGAL",
                    "msg"=>mysqli_error($conn)
                ));
                die;
            }

            // echo json_encode(mysqli_error($conn));
            // die;
            // $linkMessage = "SEGERA CEK LINK <a href='http://localhost/ricemil/supplier/index.php?page=datapesanan&modul=konf&id=$last_id'>http://localhost/ricemil/supplier/index.php?page=datapesanan&modul=konf&id=" . $last_id . "</a>";
            $linkMessage = "MOHON CEK DISINI YA http://127.0.0.1/ricemil/supplier/index.php?page=datapesanan&modul=konf&id=$last_id,THANK YOU";
            // <a href="https://meet.google.com/vmu-mxrt-pux" title="https://meet.google.com/vmu-mxrt-pux" target="_blank" rel="noopener noreferrer" class="_3-8er selectable-text copyable-text">https://meet.google.com/vmu-mxrt-pux</a>
            $send->sendMessage($np_sup,  $linkMessage); //kie ngirim wa

            echo json_encode(array(
                "status"=>"OK",
                "message"=>"Pesanan Terkirim"
            ));
            
            // $send->sendMessage($np_sup, $linkMessage . ',' . $msg); //kie ngirim wa
            // update after get response OK from Supplier
            // $queryUpdate = "UPDATE tb_barang tb SET tb.stock=(tb.stock + $jumlah) WHERE tb.Id_barang='$namaBarang'";
            // $update = mysqli_query($conn, $queryUpdate);
            // if (!$update) {
            //     die("Err Update Stock " . mysqli_error($conn));
            // }
            // header('Location:/ricemil/gudang/index.php?page=pengadaanstock');
        } else {
            echo json_encode('error ' . mysqli_error($conn));
        }
        // echo json_encode($_POST);

    }

?>