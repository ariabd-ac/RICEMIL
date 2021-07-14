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
            $exec=mysqli_query($conn,$query);
    
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
    
    
                // $linkMessage = "MOHON CEK DISINI YA http://127.0.0.1/ricemil/supplier/index.php?page=datapesanan&modul=konf&id=$idParentTrx,THANK YOU";
                // // <a href="https://meet.google.com/vmu-mxrt-pux" title="https://meet.google.com/vmu-mxrt-pux" target="_blank" rel="noopener noreferrer" class="_3-8er selectable-text copyable-text">https://meet.google.com/vmu-mxrt-pux</a>
                // $send->sendMessage($np_sup,  $linkMessage); //kie ngirim wa
    
                // $queryUpdatePhone="UPDATE tb_pengadaan_stock SET supplier_nohp='$np_sup' WHERE Id='$idParentTrx'";

    
                // $execUpdatePhone=mysqli_query($conn,$queryUpdatePhone);

                // if(!$execUpdatePhone){
                //     die(mysqli_error($conn));
                // }
                // where are we posting to?
                $url = 'http://foo.com/script.php';

                // what post fields?
                $fields = array(
                    'field1' => $field1,
                    'field2' => $field2,
                );

                // build the urlencoded data
                $postvars = http_build_query($fields);

                // open connection
                $ch = curl_init();

                // set the url, number of POST vars, POST data
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, count($fields));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);

                // execute post
                $result = curl_exec($ch);

                // close connection
                curl_close($ch);
    
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