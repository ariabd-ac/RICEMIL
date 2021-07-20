<div class="row">
    <?php
    $query = "SELECT * FROM tb_barang";
    $res = mysqli_query($conn, $query);

    if (!$res) {
        die('err' . mysqli_error($conn));
    }

    while ($r = mysqli_fetch_assoc($res)) {
        if(floor($r['stock'] / 25 ) > 0){
    ?>

        <div class="col-md-3" style="width:300px;">
            <div class="card">
                <!-- <div class="card-header">
                </div> -->
                <div class="card-body">
                    <input type="checkbox" name="" id="<?php echo $r['Id_barang']; ?>" class="item-check" data-iditem="<?php echo $r['Id_barang']; ?>" data-nameitem="<?php echo $r['Nama_barang']; ?>" data-hargaitem="<?php echo $r['harga']; ?>">
                    <div class='d-flex align-center justify-content-center'>
                        <!-- <a class='bg-image hover-overlay' href="/ricemil/reseller/index.php?page=barang&modul=detail&id=<?php echo $r['Id_barang']; ?>" style="text-decoration: none;">
                            <img src="http://localhost/ricemil/assets/images/produk/<?php echo $r['gambar'] ?>" alt="" width="100%" height="250px">
                        </a> -->
                        <a class='bg-image hover-overlay' href="#" style="text-decoration: none;">
                            <img src="http://localhost/ricemil/assets/images/produk/<?php echo $r['gambar'] ?>" alt="" width="100%" height="250px">
                        </a>
                    </div>
                    <div class="desc">
                        <h4><?php echo $r['Nama_barang'] ?></h4>
                        <p>Stock <?php echo floor($r['stock'] / 25 )." Karung" ?></p>
                        <p>Rp. <?php echo $r['harga'] ?></p>
                    </div>
                </div>
                <!-- <div class="card-footer">
                    <a class='btn btn-info' href="/ricemil/reseller/index.php?page=barang&modul=detail&id=<?php echo $r['Id_barang']; ?>">Detail</a>
                </div> -->
            </div>
        </div>
<?php
        }
     } ?>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-body-keranjang">
  Keranjang 
</button>

<!-- Modal -->
<div class="modal fade" id="modal-body-keranjang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
            <div class="alert alert-info" role="alert" id="alert">
                Keranjang kamu masi kosong lhoo,Kuy belanja !
            </div>
            <table class="table table-striped table-sm" id="tb-keranjang">
                    <thead>
                        <tr>
                        <th scope="col"></th>
                        <th scope="col">#</th>
                        <th scope="col">Nama Item</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Qty</th>
                        <th scope="col" colspan="2">Value</th>
                        
                        </tr>
                    </thead>
                    <tbody id="tb-keranjang-body">
                    </tbody>
                    <tfoot>
                        <tr class="table-active">
                            <td scope="col" colspan="5">Subtotal</td>
                            <td scope="col" colspan="2" id="subTotal-td"></td>
                        </tr>
                        <tr class="table-default">
                            <td scope="col" colspan="5"><span style="display:none;">Diskon</span></td>
                            <td scope="col" colspan="2"><input style="display:none;" style="width:80px;" class='form-control' id="discount-inp" value="0"/></td>
                        </tr>
                        <tr class="table-active">
                            <td scope="col" colspan="5">Total</td>
                            <td scope="col" colspan="2" id="total-td"></td>
                        </tr>
                        <tr class="table-default">
                            <td scope="col" colspan="5">Metode Bayar</td>
                            <td scope="col" colspan="2">
                                <select name="metodebayar" id="metodeBayar" style="width:80px" class='form-control'>
                                    <option value="0">....</option>
                                    <option value="1">COD</option>
                                    <option value="2">Upload Bukti Transaksi</option>
                            </select>
                            </td>
                        </tr>
                    </tfoot>
            </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save">Save changes</button>
      </div>
    </div>
  </div>
</div>


