<?php
     include_once "../../config/koneksi.php";
    $data=$_POST;

    if(isset($_POST['itemList']) && count($_POST['itemList']) > 0){
        $itemListString=implode(",",$_POST['itemList']);

        $dataResponse=array();
        $quer="SELECT harga,id_item FROM tb_harga_supplier WHERE id_supplier='$_POST[idSupplier]' AND id_item IN ($itemListString)";

        $execQ=mysqli_query($conn,$quer);
        if(!$execQ){
            echo json_encode(mysqli_error($conn));
        }
        while($row=mysqli_fetch_assoc($execQ)){
            array_push($dataResponse,$row);
        }
        echo json_encode($dataResponse);
    }else{
        echo 'Harap pilih item';
    }


?>