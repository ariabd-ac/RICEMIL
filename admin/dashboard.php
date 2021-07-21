<?php
    include_once "../config/koneksi.php";
    $queryTrx="SELECT 
           (SELECT COUNT(Id_transaksi) FROM tb_transaksi WHERE status IS NULL) AS totalPesan,
           (SELECT COUNT(Id_transaksi) FROM tb_transaksi WHERE status=2) AS totalDikirim,
           (SELECT COUNT(Id_transaksi) FROM tb_transaksi WHERE status=4) AS totalSelesai";

    $execTrx=mysqli_fetch_assoc(mysqli_query($conn,$queryTrx));

    $queryUsr="SELECT 
           (SELECT COUNT(user_id) FROM users WHERE level='gudang') AS totalGudang,
           (SELECT COUNT(user_id) FROM users WHERE level='reseller') AS totalReseller,
           (SELECT COUNT(user_id) FROM users WHERE level='admin') AS totalAdmin,
           (SELECT COUNT(user_id) FROM users WHERE level='kasir') AS totalKasir,
           (SELECT COUNT(user_id) FROM users WHERE level='supplier') AS totalSupplier";

    $execUsr=mysqli_fetch_assoc(mysqli_query($conn,$queryUsr));
    // die(var_dump($execUsr));
?>
<span style='display:none' id='totalGudang'><?php echo $execUsr['totalGudang']; ?></span>
<span style='display:none' id='totalReseller'><?php echo $execUsr['totalReseller']; ?></span>
<span style='display:none' id='totalAdmin'><?php echo $execUsr['totalAdmin']; ?></span>
<span style='display:none' id='totalKasir'><?php echo $execUsr['totalKasir']; ?></span>
<span style='display:none' id='totalSupplier'><?php echo $execUsr['totalSupplier']; ?></span>


<div class="card">
    <div class="card-body">
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Dashboard</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            
                            <!-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> -->
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-6 col-4 align-self-center">
                <div class="text-end upgrade-btn">
                    
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                Transaksi
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header text-center">Pesanan</div>
                                            <div class="card-body text-center align-items-center bg-info">
                                                <h2 class="h2">
                                                    <?php echo $execTrx['totalPesan'] ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header text-center">Dalam Pengiriman</div>
                                            <div class="card-body text-center align-items-center bg-warning">
                                                <h2 class="h2">
                                                    <?php echo $execTrx['totalDikirim'] ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-succes">
                                            <div class="card-header text-center">Selesai</div>
                                            <div class="card-body text-center align-items-center bg-danger">
                                                <h2 class="h2">
                                                    <?php echo $execTrx['totalSelesai'] ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Users
                            </div>
                            <div class="card-body">
                                <canvas id="myChartDonut"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>  
                    </div>
                </div>
                      
        

    </div>
</div>
<?php
    
    $query="SELECT DATE_FORMAT(Tanggal_transaksi, '%m') AS Month, SUM(subtotal-diskon) AS dt
            FROM tb_transaksi
            GROUP BY DATE_FORMAT(Tanggal_transaksi, '%m')";
    $exec=mysqli_query($conn,$query);
    if(!$exec){
        die("ERR".mysqli_error($conn));
    }

?>
<ul style='display:none'>
    <?php
        while($r=mysqli_fetch_assoc($exec)){
            ?>
                <li class='list-data' data-dt="<?php echo $r['dt']?>" data-month="<?php echo $r['Month']?>"><?php echo $r['dt']?>-<?php echo $r['Month']?></li>
            <?php
        }
    ?>
</ul>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    let dataList=document.getElementsByClassName('list-data');
    const labels = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];
    let monthIndex=[]
    let dt=[]
    
    for (let index = 0; index < dataList.length; index++) {
        const element = dataList[index];
        console.log(element)
        dt.push(element.dataset.dt)
        let bulan=element.dataset.month
        monthIndex.push(labels[Number(bulan > 0 ?bulan.replace("0",'') : bulan)-1]);
    }

    console.log(monthIndex)
    console.log(dt)

    
    const data = {
        labels: monthIndex,
        datasets: [{
            label: 'Data Pendapatan',
            backgroundColor: 'rgb(132, 99, 255)',
            borderColor: 'rgb(132, 99, 255)',
            data: dt,
        },{
            label: 'Data Pegeluaran',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [60000,100000],
        }]
    };

    const config = {
        type: 'line',
        data,
        options: {}
    };

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    let totalReseller =document.getElementById('totalReseller').innerText
    let totalGudang =document.getElementById('totalGudang').innerText
    let totalAdmin =document.getElementById('totalAdmin').innerText
    let totalKasir =document.getElementById('totalKasir').innerText
    let totalSupplier=document.getElementById('totalSupplier').innerText

    console.log("user",totalReseller)

    const dataDonut = {
        labels: [
            'Reseller',
            'Gudang',
            'Admin',
            'Kasir',
            'Supplier'
        ],
        datasets: [{
            label: 'Users',
            data: [
                totalReseller ,
                totalGudang ,
                totalAdmin ,
                totalKasir ,
                totalSupplier ],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(255, 105, 86)',
            'rgb(105, 205, 100)'
            ],
            hoverOffset: 4
        }]
    };
    

    const configDonut = {
        type: 'doughnut',
        data: dataDonut,
    };

    var myChart = new Chart(
        document.getElementById('myChartDonut'),
        configDonut
    );
</script>
   