<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Invoice</title>
    <style>
        .heading {
            background-color: aqua;
        }

        .table-item{
            padding: 4px;
        }

        .kolom-titik2 {
            width: 10px;
        }

    </style>
</head>

<body>
    {{-- <h1 align="center">Laporan Data Customer</h1> --}}
    <br><br>
    <table class="first">
        <tr>
            <td colspan="3"></td>
            <td><h2>Invoice</h2></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td><p>Invoice No. <span>{{ $sales['sales_no'] }}</span></p></td>
        </tr>
        <br><br><br><br>
        <tr>
            <td><p>Nama Customer</p></td>
            <td align="center" class="kolom-titik2">:</td>
            <td><p>{{ $sales->callCustomer['customer_name'] }}</p></td>
        </tr>
        <tr>
            <td><p>Alamat</p></td>
            <td align="center" class="kolom-titik2">:</td>
            <td><p>{{ $sales->callCustomer['customer_address'] }}</p></td>
        </tr>
        <tr>
            <td><p>Tanggal Pembelian</p></td>
            <td align="center" class="kolom-titik2">:</td>
            <td><p>{{ $sales['sales_date'] }}</p></td>
        </tr>
        <tr>
            <td><p>Gudang</p></td>
            <td align="center" class="kolom-titik2">:</td>
            <td><p>{{ $sales_item->callGudang['warehouse_name'] }}</p></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        
    </table>
    <br><br><br>
    <table border="1px" class="table-item">
        <tr class="heading">
            <td>Item</td>
            <td align="center">Harga</td>
            <td align="center">Jumlah</td>
            <td align="center">Total</td>
        </tr>
        <tr>
            <td>{{ $sales_item->callProduct['product_name'] }}</td>
            <td align="center">Rp{{ str_replace(',', '.', (number_format($sales_item['sales_item_price']))) }},00</td>
            <td align="center">{{ $sales_item['sales_item_amount'] }}</td>
            <td align="right">Rp{{ str_replace(',', '.', (number_format($sales_item['sales_item_total_price']))) }},00</td>
        </tr>
        <tr>
            <td align="center" colspan="2"><b>Total</b></td>
            <td align="center"><b>{{ $sales_item['sales_item_amount'] }}</b></td>
            <td align="right"><b>Rp{{ str_replace(',', '.', (number_format($sales_item['sales_item_total_price']))) }},00</b></td>
        </tr>
    </table>
    <br><br><br>
    <table>
        <tr>
            <td colspan="4"><p>Note:</p></td>
        </tr>
        <tr>
            <td colspan="4"><p>{{ $sales['sales_remark'] }}</p></td>
        </tr>
    </table>
</body>

</html>
