<?php

$id;
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $isRejected=NULL;
    if(isset($_GET['rejected'])){
        $isRejected=TRUE;
    }
    $query = "SELECT 
                TPS.Total,TPS.tanggal_transaksi,TPS.Id,
                TPSD.harga,TPSD.qty,TPSD.appproved_by,TPSD.id_pengadaan_stock,TPSD.id AS id_detail_pengadaan_stock,TPSD.status,TPSD.qty_rejected,TPSD.is_rejected,
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
            </tr>
        </thead>
        <tbody id="tbodyTable">
            <?php
                $num=0;
                while ($row =mysqli_fetch_assoc($result)) {
                    if($isRejected){
                        if($row['appproved_by'] != null && $isRejected == $row['is_rejected']){    
                        $num++;
                        ?>
                            <tr>
                                <td><?= $row['Id'] ?></td>
                                <td><?= $row['Nama_barang']?></td>
                                <td><img src="http://localhost/ricemil/assets/images/produk/<?php echo $row['gambar'] ?>" width="50px" height="50px" alt=""></td>
                                <td><?= $row['harga']?></td>
                                <td><?= $isRejected ? $row['qty_rejected'] : ($row['qty'] - $row['qty_rejected'] )?></td>
                                <td><?= $row['harga'] * ($row['qty'] - $row['qty_rejected'])?></td>
                            </tr>
                        <?php   
                        }
                    }else{
                        if($row['appproved_by'] != null){    
                            $num++;
                            ?>
                                <tr>
                                    <td><?= $row['Id'] ?></td>
                                    <td><?= $row['Nama_barang']?></td>
                                    <td><img src="http://localhost/ricemil/assets/images/produk/<?php echo $row['gambar'] ?>" width="50px" height="50px" alt=""></td>
                                    <td><?= $row['harga']?></td>
                                    <td><?= $isRejected ? $row['qty_rejected'] : ($row['qty'] - $row['qty_rejected'] )?></td>
                                    <td><?= $row['harga'] * ($row['qty'] - $row['qty_rejected'])?></td>
                                </tr>
                            <?php   
                        }
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
    <div class="form-group">
    <a href="<?php echo $base_url.'/document/index.php?template=purchase_order&id='.$_GET['id'] ?>" class='btn btn-success' target='_blank' name='' class='form-control'>Cetak PO</a>
    <a href="<?php echo $base_url.'/document/index.php?template=struck-supplier&id='.$_GET['id'] ?>" class='btn btn-success' target='_balnk' name='' class='form-control'>Cetak Invoice</a>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pengajuan Return</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <form action="" method="post" enctype="multipart/form-data">
        <label for="jumlah_reject">Jumlah</label>
        <input type="text" name="jml_reject" id="" class='form-control'>         
        <input type="hidden" id="id_detail" name="id_detail" id="" class='form-control'>         
      </div>
      <div class="modal-footer">
        <input type="submit" value="Return" name="reject" class="btn btn-primary">
      </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- END MODAL -->


<script>
    function openModal(id){
        let inputModalId=document.getElementById('id_detail');
        console.log(id+'haloo dari fungsi')
        inputModalId.value=id;
    }
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



