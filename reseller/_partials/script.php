<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../assets/plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="../assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/app-style-switcher.js"></script>
<!--Wave Effects -->
<script src="../assets/js/waves.js"></script>
<!--Menu sidebar -->
<script src="../assets/js/sidebarmenu.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!-- chartist chart -->
<script src="../assets/plugins/chartist-js/dist/chartist.min.js"></script>
<script src="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<!--c3 JavaScript -->
<script src="../assets/plugins/d3/d3.min.js"></script>
<script src="../assets/plugins/c3-master/c3.min.js"></script>
<!--Custom JavaScript -->
<script src="../assets/js/pages/dashboards/dashboard1.js"></script>
<script src="../assets/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>

<script>
    const itemCheck=document.getElementsByClassName('item-check');
    const modalBodyKeranjang=document.getElementById('modal-body-keranjang')
    const tbKeranjang=document.getElementById('tb-keranjang')
    const tbKeranjangBody=document.getElementById('tb-keranjang-body')
    const alert=document.getElementById('alert')
    const dataKeranjang=[]
    if(itemCheck){
        for (let index = 0; index < itemCheck.length; index++) {
            const item = itemCheck[index];
            item.addEventListener('click',(e)=>{
                let checked=e.target.checked
                
                if(checked){
                    let dataToPush={
                        "idItem":e.target.dataset.iditem,
                        "nameItem":e.target.dataset.nameitem,
                        "hargaItem":e.target.dataset.hargaitem,
                        "itemQty":1,
                    }

                    dataKeranjang.push(dataToPush)
                }else{
                    deleteItem(e.target.dataset.iditem)
                }
                generateItemKeranjang()
            })
        }
    }

    function deleteItem(idItem){
        for (let i = 0; i < dataKeranjang.length; i++) {
            const dt = dataKeranjang[i];
            if(dt.idItem == idItem){
                dataKeranjang.splice(i,1);
                document.getElementById(idItem).checked=false
            }
        }
        generateItemKeranjang()
    }

    let discount=0

    modalBodyKeranjang.addEventListener('input',(e)=>{
        const target=e.target
        

        if(target.id == "discount-inp"){
            hitung(e.target.value)
        }
        if(target.classList.contains("inp-qty")){
            let id=e.target.dataset.iditem 
            let qty=e.target.value
            
            for (let j = 0; j < dataKeranjang.length; j++) {
                const element = dataKeranjang[j];
                if(element.idItem == id){
                    dataKeranjang[j].itemQty =qty
                    generateItemKeranjang()
                    // hitung(discount)
                    // console.log(target.parentElement.nextSibling,'parent')
                    // target.parentElement.nextSibling.innerText=element.hargaItem * qty
                }
                
            } 
        
        }

        if(target.id=="save"){
            save();
        }
        
    })

    modalBodyKeranjang.addEventListener('click',(e)=>{
        const target=e.target
        

        if(target.id=="save"){
            save();
        }
        
    })

    let totalEl=document.getElementById('total-td')
    let subTotalEl=document.getElementById('subTotal-td')

    
    async function hitung(val){
        let subTotal=await getSubTotal()
        
        discount=val ? val : 0
        subTotalEl.innerText=subTotal
        totalEl.innerText=getTotal(subTotal)
    }


    function getSubTotal(){
        let subTotal=0
        for (let i = 0; i < dataKeranjang.length; i++) {
            const dt = dataKeranjang[i];
            subTotal+= dt.hargaItem * dt.itemQty
        }
        return subTotal
    }

    function getTotal(subTotal){
        return Number(subTotal) - Number(discount)
    }

    async function save(){
        let url="http://localhost/ricemil/reseller/";
        let subTotal=await getSubTotal()
        let total=await getTotal(subTotal)
        let metodeBayar=document.getElementById('metodeBayar').value
        $.ajax({
            type: "post",
            url: url,
            data: {
                save :"save",
                subTotalDetail : subTotal,
                total :total,
                diskon:discount,
                itemList:dataKeranjang,
                metodeBayar:metodeBayar
            },
            dataType: "json",
            success: function(response) {
                console.log('s', response);
                if(response.status == "OK"){
                    window.location.href="http://localhost/ricemil/reseller/index.php?page=barang";
                }
            },
            error: function(error) {
                console.log('err', error.responseText);
            }
        });
    }


    function generateItemKeranjang(){
        
        let tableHtml=''
       ;
        if(dataKeranjang.length > 0){   
         
            for (let index = 0; index < dataKeranjang.length; index++) {
                const dt = dataKeranjang[index];
                tableHtml+=`
                        <tr>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteItem(${dt.idItem})">
                                    Del 
                                </button>
                            </td>
                            <td scope="row">${index+1}</td>
                            <td>${dt.nameItem}</td>
                            <td>${dt.hargaItem}</td>
                            <td>
                                <input style="width:50px;" class='inp-qty' type="number" data-iditem="${dt.idItem}" value="${dt.itemQty}">
                                <span> Karung</span>
                            </td>
                            <td>${dt.hargaItem * dt.itemQty}</td>
                            
                        </tr>
                `;
            }
            tbKeranjang.style.display="table"

            alert.style.display='none'
            tbKeranjangBody.innerHTML=tableHtml
        }else{
            alert.style.display='block'
            // modalBodyKeranjang.innerHTML=tableHtml
            tbKeranjang.style.display="none"
        }
        hitung()

    }

    // calling method
    generateItemKeranjang()
</script>