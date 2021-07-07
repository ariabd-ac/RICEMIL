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
            $itemListUnchecked=$_POST['uncheckedList'];
            $supplier=$_SESSION['unique_id'];
            $query="UPDATE tb_pengadaan_stock_detail SET appproved_by='$supplier' WHERE id IN($itemList)";
            $exec=mysqli_query($conn,$query);
    
            if(!$exec){
                echo json_encode(mysqli_error($conn));
            }
    
            if(count($itemListUnchecked) >0){
                // send Messages
                $queryGetSupNo="SELECT phone FROM users WHERE unique_id <> $supplier AND level='supplier' ORDER BY user_id ASC";
    
                $execGetSuppNo=mysqli_query($conn,$queryGetSupNo);
                $serializeData=mysqli_fetch_assoc($execGetSuppNo);
    
                $np_sup=$serializeData['phone'];
    
    
                $linkMessage = "MOHON CEK DISINI YA http://127.0.0.1/ricemil/supplier/index.php?page=datapesanan&modul=konf&id=$idParentTrx,THANK YOU";
                // <a href="https://meet.google.com/vmu-mxrt-pux" title="https://meet.google.com/vmu-mxrt-pux" target="_blank" rel="noopener noreferrer" class="_3-8er selectable-text copyable-text">https://meet.google.com/vmu-mxrt-pux</a>
                $send->sendMessage($np_sup,  $linkMessage); //kie ngirim wa
    
                $queryUpdatePhone="UPDATE tb_pengadaan_stock SET supplier_nohp='$np_sup' WHERE Id='$idParentTrx'";
    
                $execUpdatePhone=mysqli_query($conn,$queryUpdatePhone);

                if(!$execUpdatePhone){
                    die(mysqli_error($conn));
                }
    
                echo json_encode(array(
                    "status"=>"OK",
                    "Message"=>"Succes Update Data",
                    "execUpdatePhone"=>$execUpdatePhone,
                    ""
                ));
            }
        } catch (\Throwable $th) {
            throw $th;
        //     echo json_encode(array(
        //         "status"=>"FAIL",
        //         "Message"=>"err =>".$th,
        //     ));
        }

    }
?>