<?php



require('../classsendmessage.php');
if (isset($_POST['submit'])) {

    $namaBarang = $_POST['namabarang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $np_sup = $_POST['np_sup'];
    $namabarangreal = $_POST['namabarangreal'];
    $msg = $_POST['msg'];


    $query = "INSERT INTO tb_pengadaan_stock (Nama_barang,Harga,Jumlah) VALUES ('$namaBarang','$harga','$jumlah')";

    $insert = mysqli_query($conn, $query);
    if ($insert) {
        $last_id = mysqli_insert_id($conn);
        $linkMessage = "Terdapat Pesanan Barang "+$namabarangreal+" dengan jumlah "+$jumlah+" unit,Mohon Cek disini yaa... http://127.0.0.1/ricemil/supplier/index.php?page=datapesanan&modul=konf&id="+$last_id+",Thank You ..";
        // <a href="https://meet.google.com/vmu-mxrt-pux" title="https://meet.google.com/vmu-mxrt-pux" target="_blank" rel="noopener noreferrer" class="_3-8er selectable-text copyable-text">https://meet.google.com/vmu-mxrt-pux</a>
        $send->sendMessage($np_sup,  $linkMessage); //kie ngirim wa
        // $send->sendMessage($np_sup, $linkMessage . ',' . $msg); //kie ngirim wa
        // update after get response OK from Supplier
        $queryUpdate = "UPDATE tb_barang tb SET tb.stock=(tb.stock + $jumlah) WHERE tb.Id_barang='$namaBarang'";
        $update = mysqli_query($conn, $queryUpdate);
        if (!$update) {
            die("Err Update Stock " . mysqli_error($conn));
        }
        header('Location:/ricemil/gudang/index.php?page=pengadaanstock');
    } else {
        die('error ' . mysqli_error($conn));
    }
} else {
    $query = "SELECT * FROM tb_barang";
    $res = mysqli_query($conn, $query);
}


?>

<form action="" method="post" class='container-add-gudang'>  
    <button class="btn-add btn-primary">Add</button>
    <table class="table user-table">
        <thead>
            <tr>
                <th class="border-top-0">#</th>
                <th class="border-top-0">Nama Barang</th>
                <th class="border-top-0">Gambar</th>
                <th class="border-top-0">Harga</th>
                <th class="border-top-0">Qty</th>
                <th class="border-top-0">Total</th>
            </tr>
        </thead>
        <tbody id="tbodyTable">
            
        </tbody>
        <tfoot>
            <tr>
                <th colspan='5'>Total</th>
                <th id='totalVal'>0</th>
            </tr>
        </tfoot>
    </table>
    <select id='listDataBarang' class='form-control select-item' style='display:none;'>
            <option>Pilih Item</option>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
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
    <!-- <div class="form-group">
        <label for="namabarang">Nama Barang</label>
        <select name="namabarang" id="" class='form-control'>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
                <option value="<?php echo $row['Id_barang'] ?>" 
                        id="item-opt-<?php echo $row['Id_barang'] ?>" 
                        data-hargabeli="<?php echo $row['harga_beli'] ?>"
                        data-namabarangreal="<?php echo $row['Nama_barang'] ?>"
                        >
                            <?php echo $row['Nama_barang'] ?>
                        </option>
            <?php    }
            ?>
        </select>
    </div> -->
    
    <!-- <div class="form-group">
        <label for="namabarang">Harga</label>
        <input type="text" name='harga' id="harga" class='form-control' readonly>
        <input type="hidden" name='namabarangreal' id="namabarangreal" class='form-control' >
    </div> -->
    <!-- <div class="form-group">
        <label for="namabarang">Jumlah</label>
        <input type="text" name='jumlah' class='form-control'>
    </div> -->
    <div class="form-group">
        <label for="namabarang">Pilih Supplier</label>
        <!-- <input type="text" name='no_sup' class='form-control'> -->
        <select name="np_sup" id="np_sup" class='form-control'>


            <?php
            $q = "SELECT phone,fname,lname from users WHERE level = 'supplier'";
            $rs = mysqli_query($conn, $q);
            // $rw = mysqli_fetch_assoc($rs);

            // var_dump($rw);
            // die;

            while ($rw = mysqli_fetch_assoc($rs)) {
            ?>
                <option value="<?php echo $rw['phone'] ?>">
                    <?php echo $rw['fname'] . " " . $rw['lname'] . " - " . $rw['phone'] ?>
                </option>
            <?php }

            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="namabarang">Memo</label>
        <input type="text" name='msg' class='form-control'>
        <!-- <input type="url" name="msg" class='form-control' id="msg" placeholder="https://example.com" pattern="https://.*" size="30" required> -->
    </div>
    <div class="form-group">
        <input type="submit" class='btn btn-success' id='submit' name='submit' value='submit' class='form-control'>
    </div>
</form>
<script>

    const listDataBarangEl=document.getElementById('listDataBarang');
    const containerGudang=document.getElementsByClassName('container-add-gudang');
    const tbodyTable=document.getElementById('tbodyTable');
    const totalVal=document.getElementById('totalVal');
    let num=0;

    function selectChange(val){
        // console.log(val.value)
        let opt=document.getElementById("item-opt-"+val.value);
        let harga=opt.dataset.hargabeli;
        let namabarangreal=opt.dataset.namabarangreal;
        let imgurl=opt.dataset.imgurl;
        let parent=val.parentElement.parentElement;
       
        let td3=parent.childNodes[5]
        let td4=parent.childNodes[7]
        let td5=parent.childNodes[9]
        let td6=parent.childNodes[11]
        
        let img=`<img src='${imgurl}' width='50px' height='50px'/>`;
        let inpQty=`<input type='number' style='width:50px;' class='form-control inpt-qty' data-harga='${harga}' value='1'/>`;
        td3.innerHTML=img
        td4.innerHTML=harga
        td5.innerHTML=inpQty
        td6.innerHTML=getSubTotal(harga,1)
        generateTotal()
        // parent.childNodes[1].innerHTML='OKe'
        // document.getElementById("harga").value=harga
        // document.getElementById("namabarangreal").value=namabarangreal
    }

    function generateTotal(){
        let child=tbodyTable.rows;
        // console.log(child)
        let total=0
        for (let index = 0; index < child.length; index++) {
            const el = child[index];
            total +=Number(el.childNodes[11].innerText)
            // console.log(el.childNodes[11])
            
        }
        totalVal.innerHTML=total
    }

    function getSubTotal(harga,qty){
        return Number(harga) * Number(qty);
    }

    function qtyChange(target){
        let parent=target.parentElement.parentElement;
        let td6=parent.childNodes[11]

        let valu=target.value
        let harga=target.dataset.harga
        td6.innerHTML=getSubTotal(harga,valu)
        generateTotal()
    }

    function addRow(param){
        num+=1;
        listDataBarangEl.style.display='block';
        trEl=`
            <tr>
                <td>${num}</td>
                <td>${listDataBarangEl.outerHTML}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        `;
        tbodyTable.insertAdjacentHTML("beforeend",trEl);
        listDataBarangEl.style.display='none';
    }

    function postData(param){
        let itemList=[];
        for (let index = 0; index < tbodyTable.rows.length; index++) {
            const element = tbodyTable.rows[index];
            // console.log(element.children[1].children[0].value)
            let item={
                "idItem" : element.children[1].children[0].value,
                "harga":element.children[3].innerHTML,
                "qty":element.children[4].children[0].value,
            }
            itemList.push(item)
        }
        let dataToPush={
            "submit":"submit",
            "total":totalVal.innerHTML,
            "itemList":itemList,
            "supplier":document.getElementById('np_sup').value
        }

        console.log(dataToPush)
        let url="http://localhost/ricemil/gudang/pengadaanstock/proses_add.php";
        $.ajax({
            type: "post",
            url: url,
            data: dataToPush,
            dataType: "json",
            success: function(response) {
                console.log(response);
                if(response.status == "OK"){
                    alert("Pesanan Berhasil Diterima Supplier")
                    window.location.href="http://localhost/ricemil/gudang/index.php?page=pengadaanstock";
                }
            },
            error: function(error) {
                console.log('err', error.responseText);
            }
        });
    }

    // event handler

    
    // click event on container gudang
    containerGudang[0].addEventListener('click',(e)=>{
        
        e.preventDefault();
        const target=e.target;

        if(target.classList.contains('btn-add')){
            addRow()
        }

        if(target.id == 'submit'){
            postData();
        }
    })
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