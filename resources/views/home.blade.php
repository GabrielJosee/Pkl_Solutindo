@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript" src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="assets/admin/js/Chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/a633846609.js" crossorigin="anonymous"></script>
    @if ($expired->count() > 0)
        <script>
            let message = "";
            @foreach ($expired as $exp)
                message +=
                    "{{ $exp['stock'] }} {{ $exp->callProduct['product_name'] }} Kedaluwarsa pada tanggal {{ $exp['expired_date'] }}!\n";
            @endforeach
            alert(message);
        </script>
    @endif
        <button onclick="topFunction()" id="Btn" title="Go to top">
            <i class="fa-solid fa-arrow-up"></i>
        </button>
        <style>
            *{
                scroll-behavior: smooth;
            }
            #Btn {
                display: none;
                position: fixed;
                bottom: 20px;
                right: 30px;
                z-index: 99;
                border: none;
                outline: none;
                background-color: rgb(154, 154, 154);
                color: white;
                cursor: pointer;
                padding: 20px;
                border-radius: 15px;
            }

            #Btn:hover {
                background-color: #555;
            }
        </style>
        <script type="text/javascript">
            let mybutton = document.getElementById("Btn");

            window.onscroll = function() {
                scrollFunction()
            };

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
            }

            function topFunction() {
                document.documentElement.scrollTop = 0;
            }
        </script>




    <div class="card border border-dark" style="margin-top: 30px;">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Menu Utama
            </h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class='col-md-6'>
                    <div class="card" style="height: 280px;">
                        <div class="card-header bg-secondary">
                            System
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <?php foreach($menus as $menu){
                            if($menu['id_menu']==11){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('system-user') }}'"> <i class="fa fa-angle-right"></i>
                                    User</li>
                                <?php   }
                            if($menu['id_menu']==12){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('system-user-group') }}'"> <i
                                        class="fa fa-angle-right"></i> User Group</li>
                                <?php   }
                        } 
                    ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card" style="height: 280px;">
                        <div class="card-header bg-info">
                            Konfigurasi
                        </div>
                        <div class="card-body scrollable">
                            <ul class="list-group">
                                <?php foreach($menus as $menu){
                            if($menu['id_menu']==21){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('Customer') }}'"> <i class="fa fa-angle-right"></i>
                                    Customer</li>
                                <?php   }
                            if($menu['id_menu']==22){
                        ?>
                                <li class="list-group-item main-menu-item" onClick="location.href='{{ route('product') }}'">
                                    <i class="fa fa-angle-right"></i> Product
                                </li>
                                <?php   }
                            if($menu['id_menu']==23){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('product-category') }}'"> <i
                                        class="fa fa-angle-right"></i> Product Category</li>
                                <?php   }
                                if($menu['id_menu']==24){
                        ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('stock-adjustments') }}'"> <i
                                        class="fa fa-angle-right"></i> Stock Adjustment</li>
                                <?php   }
                                if($menu['id_menu']==25){
                        ?>
                                <li class="list-group-item main-menu-item" onClick="location.href='{{ route('vouchers') }}'">
                                    <i class="fa fa-angle-right"></i> Voucher
                                </li>
                                <?php   }
                            } 
                        ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class='col-md-6'>
                    <div class="card" style="height: 280px;">
                        <div class="card-header bg-info">
                            Transaksi
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <?php foreach($menus as $menu){
                        if($menu['id_menu']==33){
                    ?>
                                <li class="list-group-item main-menu-item" onClick="location.href='{{ route('sales') }}'">
                                    <i class="fa fa-angle-right"></i> Penjualan
                                </li>
                                <?php   }
                                if($menu['id_menu']==34){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('purchase') }}'">
                                    <i class="fa fa-angle-right"></i> Pembelian
                                </li>
                                <?php   }
                        } 
                    ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card" style="height: 280px;">
                        <div class="card-header bg-secondary">
                            Laporan
                        </div>
                        <div class="card-body scrollable">
                            <ul class="list-group">
                                <?php foreach($menus as $menu){
                            if($menu['id_menu']==51){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('laporan-penjualan-per-periode') }}'"> <i
                                        class="fa fa-angle-right"></i>
                                    Laporan Penjualan per Periode</li>
                                <?php   }
                            if($menu['id_menu']==52){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('laporan-penjualan-per-produk') }}'"> <i
                                        class="fa fa-angle-right"></i>
                                    Laporan Penjualan per Produk</li>
                                <?php   }
                            if($menu['id_menu']==53){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('laporan-pembelian-per-periode') }}'"> <i
                                        class="fa fa-angle-right"></i>
                                    Laporan Pembelian per Periode</li>
                                <?php   }
                            if($menu['id_menu']==54){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('laporan-pembelian-per-produk') }}'"> <i
                                        class="fa fa-angle-right"></i>
                                    Laporan Penjualan per Produk</li>
                                <?php   }
                            if($menu['id_menu']==55){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('laporan-penjualan-penggunaan-voucher') }}'"> <i
                                        class="fa fa-angle-right"></i>
                                    Laporan Penggunaan Voucher</li>
                                <?php   }
                        } 
                    ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card" style="height: 280px;">
                        <div class="card-header bg-secondary">
                            Gudang
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <?php foreach($menus as $menu){
                            if($menu['id_menu']==70){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('warehouse') }}'"> <i class="fa fa-angle-right"></i>
                                    Gudang</li>
                                <?php   }
                            if($menu['id_menu']==71){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('pengeluaran-gudang') }}'"> <i
                                        class="fa fa-angle-right"></i>
                                    Pengeluaran Gudang</li>
                                <?php   }
                            if($menu['id_menu']==72){
                    ?>
                                <li class="list-group-item main-menu-item"
                                    onClick="location.href='{{ route('warehouse-transfer') }}'"> <i
                                        class="fa fa-angle-right"></i>
                                    Pemindahan Barang Gudang</li>
                                <?php   }
                        } 
                    ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card" style="height: 500px;">
                        <div class="card-header bg-info">
                            Persentase Penjualan Product <?php echo date('F'); ?>
                        </div>
                        <div class="card-body">
                            <div id="pie_grafik"></div>

                            <script type="text/javascript">
                                $(document).ready(function() {
                                    var product = <?php echo json_encode($product); ?>;
                                    var options = {
                                        chart: {
                                            renderTo: 'pie_grafik',
                                            plotBackgroundColor: null,
                                            plotBorderWidth: null,
                                            plotShadow: false,
                                        },
                                        title: {
                                            text: 'Persentase Penjualan Product Bulan <?php echo date('F'); ?>'
                                        },
                                        tooltip: {
                                            pointFormat: '{series.name}: <b> {point.percentage:.2f}%</b>',
                                            percentageDecimals: 2

                                        },
                                        plotOptions: {
                                            pie: {
                                                allowPointSelect: true,
                                                cursor: 'pointer',
                                                showInLegend: true,
                                                dataLabels: {
                                                    enabled: true,
                                                    color: '#000000',
                                                    connectColor: '#000000',
                                                    formatter: function() {
                                                        return '<b>' + this.point.name + '</b>: ' + this.percentage.toFixed(2) +
                                                            '%';
                                                    }
                                                }
                                            }
                                        },
                                        legend: {
                                            formatter: function() {
                                                return '<b>' + this.point.name + '</b>: ' + this.percentage.toFixed(2) +
                                                    '%';
                                            }
                                        },
                                        series: [{
                                            type: 'pie',
                                            name: 'Persentase'
                                        }]
                                    }
                                    myarray = [];
                                    $.each(product, function(index, val) {
                                        myarray[index] = [val.product_name, val.count];
                                    });
                                    options.series[0].data = myarray;
                                    chart = new Highcharts.Chart(options);
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card" style="height: 500px;">
                        <div class="card-header bg-info">
                            Grafik Penjualan Tahunan <?php echo date('Y'); ?>
                        </div>
                        <div class="card-body">
                            <div id="grafik"></div>
                            <script type="text/javascript">
                                var pendapatan = <?php echo json_encode($sales_item_total_price); ?>;
                                var tahun = <?php echo json_encode($tahun); ?>;
                                Highcharts.chart('grafik', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Grafik Penjualan Tahunan <?php echo date('Y'); ?>'
                                    },
                                    xAxis: {
                                        categories: tahun
                                    },
                                    yAxis: {
                                        title: {
                                            text: 'Nominal Pendapatan Tahunan'
                                        },
                                        labels: {
                                            formatter: function() {
                                                return Highcharts.numberFormat(this.value, 0, ",", ".");
                                            }
                                        }
                                    },
                                    plotOptions: {
                                        series: {
                                            cursor: 'pointer',
                                            allowPointSelect: true
                                        }
                                    },
                                    series: [{
                                        name: 'Nominal Pendapatan',
                                        data: pendapatan
                                    }]
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card" style="height: 500px;">
                        <div class="card-header bg-secondary">
                            Product Tidak Terjual <?php echo date('F'); ?>
                        </div>
                        <div class="card-body">
                            <div id="pie_grafik_not_sell"></div>

                            <script type="text/javascript">
                                var data = {!! json_encode($not_sell) !!};

                                var chartData = data.map(function(item) {
                                    return {
                                        name: item.product_name,
                                        y: parseInt(item.sum)
                                    };
                                });
                                var chartOptions = {
                                    chart: {
                                        type: 'pie'
                                    },
                                    title: {
                                        text: 'Product Tidak Terjual di Bulan  <?php echo date('F'); ?>'
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            showInLegend: true,
                                            dataLabels: {
                                                enabled: true,
                                                color: '#000000',
                                                connectColor: '#000000',
                                                formatter: function() {
                                                    return '<b>' + this.point.name + ':</b> Stock ' + this.y;
                                                }
                                            }
                                        }
                                    },
                                    series: [{
                                        name: 'Stock',
                                        data: chartData
                                    }]
                                };
                                Highcharts.chart('pie_grafik_not_sell', chartOptions);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    @stop

    @section('css')

    @stop

    @section('js')

    @stop
