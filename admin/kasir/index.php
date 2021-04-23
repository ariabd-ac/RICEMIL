<div class="card">
    <div class="card-header">
        <h3>Data Barang</h3>
    </div>
    <div class="card-body">
        <table class="table user-table">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">Nama Barang</th>
                    <!-- <th class="border-top-0">Gambar</th> -->
                    <th class="border-top-0">Harga</th>
                    <th class="border-top-0">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM tb_barang";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['Id_barang'] ?></td>
                        <td><?php echo $row['Nama_barang'] ?></td>
                        <!-- <td><img src="http://localhost/ricemil/assets/images/produk/<?php echo $row['gambar'] ?>" alt="alter" height="100px" width="100px"></td> -->
                        <td><?php echo $row['harga'] ?></td>
                        <td>
                            <button class='btn btn-info tambah-keranjang-kasir' 
                                    data-idbarang="<?php echo $row['Id_barang'] ?>"
                                    data-namabarang="<?php echo $row['Nama_barang'] ?>"
                                    data-hargabarang="<?php echo $row['harga'] ?>"
                                    >
                                Tambah
                            </button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h3>Keranjang Belanja</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="container">
                        <table class="table user-table">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Nama Barang</th>
                                    <th class="border-top-0">Harga</th>
                                    <th class="border-top-0">Jumlah</th>
                                    <th class="border-top-0">Sub Total</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyKeranjang">
                                
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3>Detail</h3>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="tanggal">Tanggal</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="tanggal" id="tanggal" class="form-control" value="<?php echo date('d-m-Y')?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="subtotal">Subtotal</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="subtotal" id="subtotal" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="diskon">Diskon</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="diskon" id="diskon" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="total">Total</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="total" id="total" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="bayar">Bayar</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="bayar" id="bayar" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="kembalian">Kembalian</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="kembalian" id="kembalian" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                
            </div>
            <div class="card-footer">
            <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end">
                                <input type="submit" value="Simpan" class='btn btn-primary' style="margin-right:5px;">
                                <button type="button" class='btn btn-primary'>Reset</button>
                            </div>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const btnTambahKeranjang=document.getElementsByClassName('tambah-keranjang-kasir');
    const tbodyKeranjang=document.getElementById('tbodyKeranjang');
    let subTotalDetail=document.getElementById('subtotal');

    let dataKeranjangItem=[]
    // EVENT HANDLER
    // tambah keranjang event
    if(btnTambahKeranjang){
        for (let index = 0; index < btnTambahKeranjang.length; index++) {
            const element = btnTambahKeranjang[index];
            element.addEventListener('click',(e)=>{
                
                let data={
                    idBarang:element.dataset.idbarang,
                    namaBarang:element.dataset.namabarang,
                    hargaBarang:element.dataset.hargabarang,
                    qty :0,
                }
                dataKeranjangItem.push(data)
                let resultHtml=generateItemKeranjang()
               
                tbodyKeranjang.innerHTML=resultHtml;
               
            })
        }
    }
    // end tambah keranjang event

    // tbody Keranjang Event On Input Qty
    tbodyKeranjang.addEventListener('change',async (e)=>{
        const target=e.target
        
        if(target.classList.contains('qtyKeranjang')){
            let index=target.dataset.index
          
            let qtyValue=target.value
            
            dataKeranjangItem[index].qty=qtyValue
            let resultHtml=await generateItemKeranjang()
            tbodyKeranjang.innerHTML=await resultHtml;
            await hitungSubtotal()
        }    
    })

    tbodyKeranjang.addEventListener('click',async (e)=>{
        const target=e.target
        if(target.classList.contains('delete-keranjang-kasir')){
            let index=target.dataset.index
            dataKeranjangItem.splice(index,1);
            let resultHtml=await generateItemKeranjang()
            tbodyKeranjang.innerHTML=await resultHtml;
            await hitungSubtotal()
        }
    })

    // End tbody Keranjang Event On Input Qty

    // END EVENT HANDLER

    // LIST OF FUNCTION  BELOW 

    // function generate tr on keranjang
    function generateItemKeranjang(){
        let html=''
        for (let index = 0; index < dataKeranjangItem.length; index++) {
            const data = dataKeranjangItem[index];
            html+=`
                <tr>
                    <td>${data.idBarang}</td>
                    <td>${data.namaBarang}</td>
                    <td>${data.hargaBarang}</td>
                    <td>
                        <input type="text" class='qtyKeranjang' value="${data.qty}" style='width:50px;' data-index='${index}'">
                    </td>
                    <td>
                        <input id='subTotalKeranjang${data.idBarang}' value='${Number(data.qty) * Number(data.hargaBarang)}' type="text" disabled>
                    </td>
                    <td>
                        <button class='btn btn-danger delete-keranjang-kasir' data-index='${index}'>
                            Delete
                        </button>
                    </td>
                </tr>
            `   
        }
        return html;
    }
    //end  function generate tr on keranjang

    // Hitung SubTotal Function
    function hitungSubtotal(){  
        subTotalDetail.value=dataKeranjangItem.reduce((total,num)=>{    
            return total + (num.qty * num.hargaBarang)
        },0)
    }
    // Hitung SubTotal Function End

    // END LIST OF FUNCTION


</script>
