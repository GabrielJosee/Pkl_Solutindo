<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Laporan Penjualan per Produk</title>
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <h1 align="center">Laporan Penjualan per Periode</h1>
        <h4 align="center">Periode {{$start_date}} s/d {{$end_date}}</h4>
        <table class="static" rules="all" border="1px" style="width: 95%; ">
            <tr align="center">
                <th width="10%"><b>No</b></th>
                <th width="40%"><b>Nama Produk</b></th>
                <th width="20%"><b>Jumlah Produk</b></th>
                <th width="30%"><b>Nominal</b></th>
            </tr>
            <?php $no = 1; ?>
            @foreach ($sales_item as $si)
                <tr>
                    <td width="10%" align="center">{{ $no }}</td>
                    <td width="40%" align="left">{{ $si->callProduct['product_name'] }}</td>
                    <td width="20%" align="center">{{ $si['sales_item_amount'] }}</td>
                    <td width="30%" align="right">Rp{{str_replace(',', '.', (number_format($si['sales_item_total_price'])))}},00</td>
                </tr>
                <?php $no++; ?>
            @endforeach
            <tr>
                <td colspan="3" align="center"><b>Total</b></td>
                <td align="right"><b>Rp{{ number_format($total_price) }},00</b></td>
            </tr>
        </table>
    </div>
</body>

</html>
