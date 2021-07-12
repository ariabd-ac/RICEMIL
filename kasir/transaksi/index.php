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
            <td><?php echo $row['harga'] / 25 ?></td>
            <td>
              <button class='btn btn-info tambah-keranjang-kasir' data-idbarang="<?php echo $row['Id_barang'] ?>" data-namabarang="<?php echo $row['Nama_barang'] ?>" data-hargabarang="<?php echo $row['harga'] ?>">
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
                  <th class="border-top-0">Kg</th>
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
        <!-- <form action=""> -->
        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <label for="tanggal">Tanggal</label>
            </div>
            <div class="col-md-6">
              <input type="text" name="tanggal" id="tanggal" class="form-control" value="<?php echo date('d-m-Y') ?>" readonly>
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
              <input type="submit" onclick="save()" value="Simpan" id="save" class='btn btn-primary' style="margin-right:5px;">
              <button type="button" class='btn btn-primary'>Reset</button>
            </div>
          </div>
        </div>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>

<script>
  const btnTambahKeranjang = document.getElementsByClassName('tambah-keranjang-kasir');
  const tbodyKeranjang = document.getElementById('tbodyKeranjang');
  let subTotalDetail = document.getElementById('subtotal');
  const diskonElement = document.getElementById('diskon');
  const bayarElement = document.getElementById('bayar');
  const kembalianElement = document.getElementById('kembalian');
  const totalElement = document.getElementById('total');

  // initialized
  diskonElement.value = 0
  bayarElement.value = 0
  kembalianElement.value = 0
  // initialized

  let dataKeranjangItem = []
  // EVENT HANDLER
  // tambah keranjang event
  if (btnTambahKeranjang) {
    for (let index = 0; index < btnTambahKeranjang.length; index++) {
      const element = btnTambahKeranjang[index];
      element.addEventListener('click', (e) => {

        let data = {
          idBarang: element.dataset.idbarang,
          namaBarang: element.dataset.namabarang,
          hargaBarang: element.dataset.hargabarang,
          qty: 0,
        }
        dataKeranjangItem.push(data)
        let resultHtml = generateItemKeranjang()

        tbodyKeranjang.innerHTML = resultHtml;

      })
    }
  }
  // end tambah keranjang event

  // tbody Keranjang Event On Input Qty
  tbodyKeranjang.addEventListener('change', async (e) => {
    const target = e.target

    if (target.classList.contains('qtyKeranjang')) {
      let index = target.dataset.index

      let qtyValue = target.value

      dataKeranjangItem[index].qty = qtyValue
      let resultHtml = await generateItemKeranjang()
      tbodyKeranjang.innerHTML = await resultHtml;
      await hitungSubtotal()
    }
  })

  tbodyKeranjang.addEventListener('click', async (e) => {
    const target = e.target
    if (target.classList.contains('delete-keranjang-kasir')) {
      let index = target.dataset.index
      dataKeranjangItem.splice(index, 1);
      let resultHtml = await generateItemKeranjang()
      tbodyKeranjang.innerHTML = await resultHtml;
      await hitungSubtotal()
    }
  })

  // End tbody Keranjang Event On Input Qty

  // Diskon On Input
  diskonElement.addEventListener('input', (e) => {
    let target = e.target;
    hitungTotal()
  })
  // End Diskon On Input

  // bayar event on input
  bayarElement.addEventListener('input', (e) => {
    let target = e.target;
    hitungKembalian()
  })
  // bayar on Input

  // END EVENT HANDLER

  // LIST OF FUNCTION  BELOW 

  // function generate tr on keranjang
  function generateItemKeranjang() {
    let html = ''
    for (let index = 0; index < dataKeranjangItem.length; index++) {
      const data = dataKeranjangItem[index];
      let hargaKg = Number(data.hargaBarang)/ 25; 
      html += `
                <tr>
                    <td>${data.idBarang}</td>
                    <td>${data.namaBarang}</td>
                    <td>${hargaKg}</td>
                    <td>
                        <input type="text" class='qtyKeranjang' value="${data.qty}" style='width:50px;' data-index='${index}'">
                    </td>
                    <td>
                        <input id='subTotalKeranjang${data.idBarang}' style='width:100px;' value='${Number(data.qty) * Number(hargaKg)}' type="text" disabled>
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
  //end  function generate tr keranjang

  // Hitung SubTotal Function
  function hitungSubtotal() {
    subTotalDetail.value = dataKeranjangItem.reduce((total, num) => {
      return total + (num.qty * (num.hargaBarang/25))
    }, 0)

    hitungTotal()
    hitungKembalian()
  }
  // Hitung SubTotal Function End

  // function hitungTotal
  function hitungTotal() {
    let diskon = diskonElement.value
    let subTotal = subTotalDetail.value

    let total = subTotal - diskon
    totalElement.value = total
  }
  // function hitungTotal End


  // function hitungKembalian
  function hitungKembalian() {
    let total = totalElement.value
    let bayar = bayarElement.value
    kembalianElement.value = bayar - total
  }
  // function hitungKembalian End


  function submit() {
    let subTotal = [] //get by element
    let total = [] //get by element
    let discount = [] //get by element
    let itemlist = []

    let data = {
      subtotal: subtotal,
      subtotal: subtotal,
      luistItem: dataKeranjangItem
    }

  }

  // END LIST OF FUNCTION

  // submit 
  // function submitOnDb() {
  //   let subTotalDetail = document.getElementById('subtotal');
  //   let total = document.getElementById('total');
  //   let diskon = document.getElementById('diskon');
  //   let itemList = [];
  //   // const result = itemList.filter(itemList => itemList.length);




  //   // for (let index = 0; index < dataKeranjangItem.length; index++) {
  //   //   const data = dataKeranjangItem[index];
  //   //   let obj = new Object(data);
  //   // }

  //   // itemList.push(obj);


  //   let data = {
  //     subTotalDetail: subTotalDetail.value,
  //     total: total.value,
  //     diskon: diskon.value,
  //     itemList: dataKeranjangItem,
  //   }


  //   console.log('data: ', data);


  // }

  async function save() {
    let url = "http://localhost/ricemil/kasir/";
    // let subTotal = await getSubTotal()
    // let total = await getTotal(subTotal)
    // let metodeBayar = document.getElementById('metodeBayar').value


    let subTotalDetail = document.getElementById('subtotal');
    // let qty = document.getElementById('qty');
    let total = document.getElementById('total');
    let diskon = document.getElementById('diskon');
    let itemList = [];

    // let data = {
    //   save: "save",
    //   subTotalDetail: subTotalDetail.value,
    //   total: total.value,
    //   diskon: diskon.value,
    //   itemList: dataKeranjangItem,
    //   // metodeBayar: metodeBayar
    // }

    // console.log('d', data);



    $.ajax({
      type: "post",
      url: url,
      data: {
        save: "save",
        subTotalDetail: subTotalDetail.value,
        total: total.value,
        diskon: diskon.value,
        itemList: dataKeranjangItem,
        // metodeBayar: metodeBayar
      },
      dataType: "json",
      success: function(response) {
        console.log('s', response);
        if (response.status == "OK") {
          let id_trx=response.idTrx;
          let dibayar=bayarElement.value
          let discount= diskonElement.value

          window.location.href = "http://localhost/ricemil/document/index.php?template=struck-kasir&id="+id_trx+"&dibayar="+dibayar+"&discount="+discount;
        }
      },
      error: function(error) {
        console.log('err', error.responseText);
      }
    });
  }
</script>