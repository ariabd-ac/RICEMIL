<?php
    include_once "../../config/koneksi.php";
    require('../../classsendmessage.php');
    session_start();
    if(isset($_POST['submit'])== "updateDetail"){

        try {
            //code...
            $idParentTrx=$_POST['idParentTrx'];
            $itemList=$_POST['itemList'];
            $itemList=implode(",",$itemList);
            $itemListUnchecked=isset($_POST['uncheckedList']) ? $_POST['uncheckedList'] : [] ;
            $supplier=$_SESSION['unique_id'];
            $query="UPDATE tb_pengadaan_stock_detail SET appproved_by='$supplier' WHERE id IN($itemList)";
            $queryUpdateApprove="UPDATE tb_pengadaan_stock SET is_approve='1' WHERE Id='$idParentTrx'";
            $exec=mysqli_query($conn,$query);
            $exec2=mysqli_query($conn,$queryUpdateApprove);
            if(!$exec){
                echo mysqli_error($conn);
                die;
            }
    
            if(count($itemListUnchecked) >0){
                // send Messages
                $queryGetSupNo="SELECT phone FROM users WHERE unique_id <> $supplier AND level='supplier' ORDER BY user_id ASC";
    
                $execGetSuppNo=mysqli_query($conn,$queryGetSupNo);
                $serializeData=mysqli_fetch_assoc($execGetSuppNo);
    
                $np_sup=$serializeData['phone'];
                // $queryUpdatePhone="UPDATE tb_pengadaan_stock SET supplier_nohp='$np_sup' WHERE Id='$idParentTrx'";
                $total=0;
                $no_po="PO".date('Ymd-Hi');
                $queryInsertNewTrx="INSERT INTO tb_pengadaan_stock (Total,supplier_nohp,no_po) VALUES ('$total','$np_sup','$no_po')";

                $execNewTrx=mysqli_query($conn,$queryInsertNewTrx);

                if(!$execNewTrx){
                    die(mysqli_error($conn));
                }

                $last_id = mysqli_insert_id($conn);
                $queryInsertDetail="INSERT INTO tb_pengadaan_stock_detail (id_pengadaan_stock,id_item,harga,qty)  
                        SELECT '$last_id',tb2.id_item,tb2.harga,tb2.qty FROM tb_pengadaan_stock_detail tb2 WHERE tb2.id_pengadaan_stock='$idParentTrx' AND tb2.appproved_by IS NULL";
                
                $insertDetail=mysqli_query($conn,$queryInsertDetail);

                if(!$insertDetail){
                    echo json_encode(array(
                        "status"=>"GAGAL",
                        "msg"=>mysqli_error($conn)
                    ));
                    die;
                }

                $linkMessage = "MOHON CEK DISINI YA http://127.0.0.1/ricemil/supplier/index.php?page=datapesanan&modul=konf&id=$$last_id,THANK YOU";
                // <a href="https://meet.google.com/vmu-mxrt-pux" title="https://meet.google.com/vmu-mxrt-pux" target="_blank" rel="noopener noreferrer" class="_3-8er selectable-text copyable-text">https://meet.google.com/vmu-mxrt-pux</a>
                $send->sendMessage($np_sup,  $linkMessage); //kie ngirim wa

            }
            echo json_encode(array(
                "status"=>"OK",
                "Message"=>"Succes Update Data",
            ));

        } catch (\Throwable $th) {
            throw $th;
        //     echo json_encode(array(
        //         "status"=>"FAIL",
        //         "Message"=>"err =>".$th,
        //     ));
        }

    }
?>