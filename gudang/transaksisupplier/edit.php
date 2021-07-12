<?php

$id;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // die($id);
    $query = "SELECT 
                TPS.Total,TPS.tanggal_transaksi,TPS.Id,
                TPSD.harga,TPSD.qty,TPSD.appproved_by,TPSD.id_pengadaan_stock,TPSD.id AS id_detail_pengadaan_stock,TPSD.status,
                TB.Nama_barang,TB.gambar,TB.Id_barang
                FROM tb_pengadaan_stock TPS 
                LEFT JOIN tb_pengadaan_stock_detail TPSD ON TPSD.id_pengadaan_stock=TPS.Id
                LEFT JOIN tb_barang TB ON TPSD.id_item=TB.Id_barang 
                WHERE TPS.Id='$id'";
    $result=mysqli_query($conn,$query);

    if(!$result){
        die(mysqli_error($conn));
    }
}


if(isset($_POST['submit'])){
    // die($_POST['status']);
    $statusPost=(int)$_POST['status'] + 1;

    // die($statusPost."STATUS POST");
    
    $queryUpdateStatus="UPDATE tb_pengadaan_stock_detail TAB SET TAB.status='$statusPost' WHERE TAB.id_pengadaan_stock='$id' AND TAB.appproved_by='$_SESSION[unique_id]'";
    $execUpdateStatus=mysqli_query($conn,$queryUpdateStatus);

    if(!$execUpdateStatus){
        die(mysqli_error($conn));
    }else{
        header('Location:/ricemil/admin/index.php?page=transaksi');
    }
}

if(isset($_POST['reject'])){
    // die($_POST['status']);
    // $statusPost=(int)$_POST['status'] + 1;

    // die($statusPost."STATUS POST");
    
    $queryUpdateStatusReject="UPDATE tb_pengadaan_stock_detail TAB SET TAB.is_rejected=true,TAB.qty_rejected='$_POST[qty_rejected]',TAB.qty=((SELECT TB2.qty FROM tb_pengadaan_stock_detail TB2 WHERE TB2.id_pengadaan_stock='$id') - $_POST[qty_rejected]) WHERE TAB.id_pengadaan_stock_detail='$id'";
    $execUpdateStatus=mysqli_query($conn,$queryUpdateStatusReject);

    if(!$execUpdateStatus){
        die(mysqli_error($conn));
    }else{
        header('Location:/ricemil/admin/index.php?page=transaksi');
    }
}

    
?>

<form action="" method="post" class='container-add-gudang'>  
    <!-- <button class="btn-add btn-primary">Add</button> -->

    <table class="table user-table">
        <thead>
            <tr>
                <th class="border-top-0">#</th>
                <th class="border-top-0">Nama Barang</th>
                <th class="border-top-0">Gambar</th>
                <th class="border-top-0">Harga</th>
                <th class="border-top-0">Qty</th>
                <th class="border-top-0">SubTotal</th>
                <!-- <th class="border-top-0">Action</th> -->
            </tr>
        </thead>
        <tbody id="tbodyTable">
            <?php
                $num=0;
                while ($row =mysqli_fetch_assoc($result)) {
                    // var_dump($row);
                    
                    if($row['Id']== $id && $row['status'] == "2"){
                        $status=$row['status'] ? $row['status'] : 0;
                    $num++;
            ?>
                <tr>
                    <td><?= $row['Id'] ?></td>
                    <td><?= $row['Nama_barang']?></td>
                    <td><img src="http://localhost/ricemil/assets/images/produk/<?php echo $row['gambar'] ?>" width="50px" height="50px" alt=""></td>
                    <td><?= $row['harga']?></td>
                    <td><?= $row['qty']?></td>
                    <td><?= $row['harga'] * $row['qty']?></td>
                    <!-- <td>
                        <input type="checkbox" name="" data-idparenttrxt="<?php echo $id ?>" data-id="<?php echo $row['id_detail_pengadaan_stock']?>" class="check-item">
                    </td> -->
                </tr>
            <?php
            
        }
                }
            ?>
        </tbody>
        <tfoot>
            <!-- <tr>
                <th colspan='5'>Total</th>
                <th id='totalVal'>0</th>
            </tr> -->
        </tfoot>
    </table>
    <select id='listDataBarang' class='form-control select-item' style='display:none;'>
            <option>Pilih Item</option>
            <?php
            $status;
            while ($row = mysqli_fetch_assoc($res)) {
                // $status=$row['status'] ? $row['status'] : 0;
            ?>
                <option class="select-item-list"
                        value="<?php echo $row['Id_barang'] ?>" 
                        id="item-opt-<?php echo $row['Id_barang'] ?>" 
                        data-hargabeli="<?php echo $row['harga_beli'] ?>"
                        data-namabarangreal="<?php echo $row['Nama_barang'] ?>"
                        data-imgurl="http://localhost/ricemil/assets/images/produk/<?php echo $row['gambar'] ?>"
                        >
                            <?php echo $row['Nama_barang'] ?>
                </option>
            <?php 
               }
            ?>
    </select>
    
    <?php if($_GET['status'] == 2){?>
        <div class="form-group">
            <input type="hidden" name="status" value="<?php echo $_GET['status'] ? $_GET['status'] : 0 ?>">
            <input type="submit" class='btn btn-success' name='submit' value='submit' class='form-control'>
            <button type="button" class='btn btn-danger' style='margin-left:20px;' id='btn-reject' class='form-control'>Reject</button>
            <br>
            <br>
            <div class="row">
                <div class="form-group" id='form-reject' style='display:none;' class='col-md-3'>
                    <label for="">Jumlah yang di reject</label>
                    <input type="text" name="qty_rejected" id="qty_rejected"  class='form-control' style='width:100px;'>
                    <br>
                    <input type="submit" class='btn btn-info' name='reject' value='Reject' class='form-control'>
                </div>
            </div>
        </div>
    <?php }?>
</form>
<script>
    document.getElementById('btn-reject').addEventListener('click',()=>{
        console.log("OKE")
        document.getElementById('form-reject').style.display='block';
    })
    const listDataBarangEl=document.getElementById('listDataBarang');
    const containerGudang=document.getElementsByClassName('container-add-gudang');
    const tbodyTable=document.getElementById('tbodyTable');
    const totalVal=document.getElementById('totalVal');
    let num=0;

    function selectChange(val){
        // console.log(val.value)
    }

    function generateTotal(){
    }

    function getSubTotal(harga,qty){
    }

    function qtyChange(target){

    }

    function addRow(param){

    }

    function postData(param){
        let itemList=[];
        let itemListUnchecked=[];
        let idparentTrx;
        for (let index = 0; index < tbodyTable.rows.length; index++) {
            const element = tbodyTable.rows[index];
            let checkList=element.children[6].children[0];
            idparentTrx=checkList.dataset.idparenttrxt
            // let item={
            //     "idItem" : element.children[0].innerHTML,
            //     "harga":element.children[3].innerHTML,
            //     "qty":element.children[4].children[0].value,
            // }
            if(checkList.checked){
                itemList.push(checkList.dataset.id)
            }else{
                itemListUnchecked.push(checkList.dataset.id)
            }
        }
        let dataToPush={
            "submit":"updateDetail",
            "idParentTrx":idparentTrx,
            "itemList":itemList,
            "uncheckedList":itemListUnchecked
        }
        let url="http://localhost/ricemil/supplier/datapesanan/proses_update_detail.php";
        $.ajax({
            type: "post",
            url: url,
            data: dataToPush,
            dataType: "json",
            success: function(response) {
                console.log('response', response);
                if(response.status == "OK"){
                    alert("Sukses");
                    window.location.href="http://localhost/ricemil/supplier/index.php?page=datapesanan";
                }
            },
            error: function(error) {
                console.log('err', error.responseText);
            }
        });
    }

    // event handler

    
    // click event on container gudang
    // containerGudang[0].addEventListener('click',(e)=>{
        
    //     const target=e.target;
    //     if(target.classList.contains('check-item')){
    //         let id_detail=target.dataset.id
    //         console.log(id_detail)
    //         return true;
    //     }
    //     e.preventDefault();
    //     if(target.classList.contains('btn-add')){
    //         addRow()
    //     }

    //     if(target.id == 'submit'){
    //         postData();
    //     }
    // })
      // change event on container gudang
    containerGudang[0].addEventListener('change',(e)=>{
        const target=e.target;
        if(target.classList.contains('select-item')){
            selectChange(target)
        }

        if(target.classList.contains('inpt-qty')){
            qtyChange(target)
        }
    })

</script>



